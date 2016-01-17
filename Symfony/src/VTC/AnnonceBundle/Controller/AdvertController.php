<?php

// src/VTC/AnnonceBundle/Controller/AdvertController.php

namespace VTC\AnnonceBundle\Controller;

use Symfony\Component\Validator\Constraints as Assert;
use VTC\AnnonceBundle\Entity\Advert;
use VTC\UserBundle\Entity\User;
use VTC\AnnonceBundle\Entity\Image;


use VTC\AnnonceBundle\Form\AdvertType;
use VTC\AnnonceBundle\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VTC\AnnonceBundle\Form\AdvertEditType;
use VTC\AnnonceBundle\Form\SearchType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Liip\ImagineBundle\LiipImagineBundle;
use VTC\AnnonceBundle\Stats;



class AdvertController extends Controller
{
 	  public function indexAction($page)
  {
      $ip = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
      $heure = date("H:i");
      $substite = date ('-5 H');


     $this->container->get('vtc_platform.visit_stats')->addVisit();
    
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    $form = $this->createForm(new SearchType());

    // Ici je fixe le nombre d'annonces par page à 3
    // Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
    $nbPerPage = 10;

    // On récupère notre objet Paginator
    $listAdverts = $this->getDoctrine()
      ->getManager()
      ->getRepository('VTCAnnonceBundle:Advert')
      ->getAdverts($page, $nbPerPage)
    ;

    // On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
    $nbPages = ceil(count($listAdverts)/$nbPerPage);
    $total = count($listAdverts);
    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

    // On donne toutes les informations nécessaires à la vue
    return $this->render('VTCAnnonceBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts,
      'nbPages'     => $nbPages,
      'page'        => $page,
      'total'       => $total,
      'form' => $form->createView(),
     'heure'=> $heure,
     'substite' => $substite,
    ));

  }

  public function viewAction($id, Request $request)
   {
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $advert = $em->getRepository('VTCAnnonceBundle:Advert')->find($id);

    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
     if($request->getMethod() == 'POST')

        {
          $message= \Swift_Message::newInstance()
          ->setSubject('Votre annonce ' . $advert->getTitle() . ' sur le site Entre VtC ')
          ->setFrom('parisparcoeur@gmail.com')
          ->setTo($_POST['mail'])             //$advert->getUser()->getEmailCanonical()
          ->setCharset('utf-8')
          ->setContentType('text/html')
          ->setBody($this->renderView('VTCAnnonceBundle:Swiftlayout:contactbetween.html.twig',array('advert' =>$advert,
            'mail' =>$_POST['mail'], 'msg' => $_POST['msg'], 'phone' => $_POST['phone'], 'name' =>$_POST['name'])
          ));

          $this->get('mailer')->send($message);

          $request->getSession()->getFlashBag()->add('notice', 'Votre message a bien etait envoyer.');

      return $this->redirect($this->generateUrl('vtc_platform_home'));
    }

   return $this->render('VTCAnnonceBundle:Advert:view.html.twig', array(
      'advert' => $advert,
     
    ));   
  }

  public function contactAction(Request $request)
  {

        if($request->getMethod() == 'POST')
        {
          $message= \Swift_Message::newInstance()
          ->setSubject('Votre annonce ' . $advert->getTitle() . ' sur le site Entre VtC ')
          ->setFrom('parisparcoeur@gmail.com')
          ->setTo('parisparcoeur@gmail.com')             //$advert->getUser()->getEmailCanonical()
          ->setCharset('utf-8')
          ->setContentType('text/html')
          ->setBody($this->renderView('VTCAnnonceBundle:Swiftlayout:contactus.html.twig',array(
            'mail' =>$_POST['mail'], 'msg' => $_POST['msg'], 'phone' => $_POST['phone'], 'name' =>$_POST['name'])
          ));

          $this->get('mailer')->send($message);

          $request->getSession()->getFlashBag()->add('notice', 'Votre message a bien etait envoyer.');

      return $this->redirect($this->generateUrl('vtc_platform_home'));
    }
    return $this->render('VTCAnnonceBundle:Advert:contact.html.twig');


  }
  public function accountAction(Request $request)
  {

    if (!$this->get('security.context')->isGranted('ROLE_USER')) {
   

      $request->getSession()->getFlashBag()->add('danger', 'Vous devez vous connecter ou vous inscrire pour avoir un compte');

       return $this->redirectToRoute('fos_user_security_login');
    }

    $id = $this->get('security.token_storage')->getToken()->getUser();

   
    $em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $advert = $em->getRepository('VTCAnnonceBundle:Advert')->getUserAdverts($id);
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
    
    return $this->render('VTCAnnonceBundle:Advert:myaccount.html.twig',array(
      'advert' => $advert,
      ));

  }
  

  public function addAction(Request $request)
  {
    
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $advert = new Advert();
    $form = $this->get('form.factory')->create(new AdvertType(), $advert);
    $validator = $this->get('validator');
    $errors = $validator->validate($advert);
    
    if (!$this->get('security.context')->isGranted('ROLE_USER')) {
   

      $request->getSession()->getFlashBag()->add('danger', 'Vous devez vous connecter ou vous inscrire pour pouvoir deposer une annonce');

       return $this->redirectToRoute('fos_user_security_login');
    }

    if ($form->handleRequest($request)->isValid())
    {
         // --- Dans le cas où vous avez un champ "articleCompetences" dans le formulaire - 1/2 ---
        // Cette ligne est nécessaire pour qu'on puisse enregistrer en bdd en deux étapes :
        // * D'abord l'article tout seul (c'est pour ça qu'on enlève les articleCompetences)
        // * Puis les articleCompetences, juste après, car on a besoin de l'id de l'$article
        //   Or cet id n'est attribué qu'au flush, car on utilise l'AUTOINCREMENT de MySQL !
        $advert->getImages()->clear();
        $advert->setUser($user);
        // --- Fin du cas 1/2 ---
        // On enregistre l'objet $article dans la base de données
        $em = $this->getDoctrine()->getManager();
        $em->persist($advert);
        $em->flush();
        // --- Dans le cas où vous avez un champ "articleCompetences" dans le formulaire - 2/2 ---
        // Maintenant que l'artiche est enregistré et dispose d'un id,
        // On parcourt les articleCompetences pour leur ajouter l'article et les persister manuellement
        // (rappelez-vous, c'est articleCompetence la propriétaire dans sa relation avec Article !)
        foreach ($form->get('images')->getData() as $adv) {
          $adv->setAdvert($advert);
          $em->persist($adv);
        }
        
        $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Voici Votre Annonce, elle est en cours de validation .');

      return $this->redirect($this->generateUrl('vtc_platform_view', array('id' => $advert->getId())));
    }

    return $this->render('VTCAnnonceBundle:Advert:add.html.twig', array(
      'form' => $form->createView(),
      'errors' => $errors 
    
    ));

  }
    public function deleteAdminAction($id, Request $request)
    {
      $em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $advert = $em->getRepository('VTCAnnonceBundle:Advert')->find($id);
    $form = $this->createFormBuilder()->getForm();
     if ($form->handleRequest($request)->isValid()) {
      $em->remove($advert);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', "L'annonce a bien été supprimée.");
      return $this->redirect($this->generateUrl('vtc_platform_home'));
    }
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('VTCAnnonceBundle:Advert:delete.html.twig', array(
      'advert' => $advert,
      'form'   => $form->createView()
    ));
  }


     public function deleteAction($id, Request $request)
  {
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    $userrole = $user->getRoles();
    $advert = $em->getRepository('VTCAnnonceBundle:Advert')->find($id);

   
    $deladvert = $advert->getUser();

    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille



    $form = $this->createFormBuilder()->getForm();

  
    if (($deladvert == $user) || ($this->get('security.context')->isGranted('ROLE_ADMIN'))) {



    if ($form->handleRequest($request)->isValid()) {
      $em->remove($advert);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', "L'annonce a bien été supprimée.");
      return $this->redirect($this->generateUrl('vtc_platform_home'));
    }
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('VTCAnnonceBundle:Advert:delete.html.twig', array(
      'advert' => $advert,
      'form'   => $form->createView()
    ));
      
    }

    else{


    $request->getSession()->getFlashBag()->add('notice', "Vous ne pouvez pas supprimer cette annonce");
      return $this->redirect($this->generateUrl('vtc_platform_home'));

  }
  }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $user = $this->get('security.token_storage')->getToken()->getUser();
    // On récupère l'annonce $id
    $advert = $em->getRepository('VTCAnnonceBundle:Advert')->find($id);
    $deladvert = $advert->getUser();

    $admin = $user->getRoles();

    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }
    if (($deladvert == $user) || ($this->get('security.context')->isGranted('ROLE_ADMIN')))
    {
    $form = $this->createForm(new AdvertEditType(), $advert);

    if ($form->handleRequest($request)->isValid()) {
      foreach ($form->get('images')->getData() as $adv) {
          $adv->setAdvert($advert);
          $em->persist($adv);
        }
        $em->flush();
      // Inutile de persister ici, Doctrine connait déjà notre annonce
    

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('vtc_platform_view', array('id' => $advert->getId())));
    }

    return $this->render('VTCAnnonceBundle:Advert:edit.html.twig', array(
      'form'   => $form->createView(),
      'advert' => $advert // Je passe également l'annonce à la vue si jamais elle veut l'afficher
    ));
  }
  else {

    $request->getSession()->getFlashBag()->add('notice', "Vous ne pouvez pas modifier cette annonce");
    return $this->redirect($this->generateUrl('vtc_platform_home'));

  }
}

  public function mysearchAction(Request $request)
  {
    
    $form = $this->createForm(new SearchType());

    $request = $this->getRequest();

    if($request->getMethod() == 'POST')

        {

        $form->bind($request);

        //On vérifie que les valeurs entrées sont correctes

        if($form->isValid())

        {

        $em = $this->getDoctrine()->getManager();

        //On récupère les données entrées dans le formulaire par l'utilisateur

        $data = $this->getRequest()->request->get('vtc_annoncebundle_search');

        //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

        $listAdv = $em->getRepository('VTCAnnonceBundle:Advert')->getSearchForm($data);

        //Puis on redirige vers la page de visualisation de cette liste d'annonces

        return $this->render('VTCAnnonceBundle:Advert:searchresult.html.twig', array('listAdv' => $listAdv));

        }

        }

        // À ce stade :

        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire

        // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau

        return $this->render('VTCAnnonceBundle:Advert:searchform.html.twig', array('form' => $form->createView()));
    
  }

  public function adminAction()
  {
    $em = $this->getDoctrine()->getManager();

   
    // recupere tous les user
    $listUsers = $em->getRepository('VTCUserBundle:User')->findAll();
    $listadverts = $em->getRepository('VTCAnnonceBundle:Advert')->findAll();
    $totalAdverts = count($listadverts);
    $totalUsers = count($listUsers);
    

     return $this->render('VTCAnnonceBundle:Advert:admin.html.twig', array(
      'listUsers' => $listUsers,
      'totalAdverts' => $totalAdverts,
      'totalUsers' => $totalUsers
      
    ));

  }

    public function deleteuserAction($id, Request $request)
    {

    $user = $this->get('security.token_storage')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();
    
    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->createFormBuilder()->getForm();

     {

    if ($form->handleRequest($request)->isValid()) {

    /*  foreach ($listadvertuser as $adv)
       {
          $em->remove($adv);
          $em->flush();
        }
    */
      $em->remove($user);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', "Votre compte a bien été supprimer.");
      return $this->redirect($this->generateUrl('vtc_platform_home'));
    }
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('VTCAnnonceBundle:Advert:deleteuser.html.twig', array(
      'user' => $user,
      'form'   => $form->createView()
    )); 
    }
  }



  public function adminuserviewAction($id, Request $request)
   {
    $em = $this->getDoctrine()->getManager();
    $listadvertuser = $em->getRepository('VTCAnnonceBundle:Advert')->getUserAdverts($id);
    
  return $this->render('VTCAnnonceBundle:Advert:adminuserview.html.twig', array(
      'listadvertuser' => $listadvertuser,
    ));
  }


   public function admindeleteuserAction($id, Request $request)
   {

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('VTCUserBundle:User')->find($id);
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($user);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', "Le compte a bien était supprimer.");
      return $this->redirect($this->generateUrl('vtc_platform_admin'));
    }
    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('VTCAnnonceBundle:Advert:admindeleteuser.html.twig', array(
      'user' => $user,
      'form'   => $form->createView()
    )); 
    }



 
  public function menuAction()
  {
    $em = $this->getDoctrine()->getManager();
    
    $listAdverts = $em->getRepository('VTCAnnonceBundle:Advert')->getFiveFirst();


    return $this->render('VTCAnnonceBundle:Advert:menu.html.twig', array(
      'listAdverts' => $listAdverts
    ));
  }
}