<?php

namespace VTC\AnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

           // ->add('date')
            ->add('dept', 'choice', array('choices'  => array('Alsace' => 'Alsace', 'Aquitaine' => 'Aquitaine', 'Auvergne' => 'Auvergne', 'Basse-Normandie' => 'Basse-Normandie', 'Bourgogne' => 'Bourgogne', 'Bretagne' => 'Bretagne', 'Centre' => 'Centre', 'Champagne-Ardenne' => 'Champagne-Ardenne', 'Corse' => 'Corse', 'Franche-Comté' => 'Franche-Comté', 'Haute-Normandie' => 'Haute-Normandie', '75' => '75 Paris', '77' => '77 Seine et Marne', '78' => '78 Yvelines', '91' => '91 Essonne', '92' => '92 Haut de Seine', '93' => '93 Seine saint Denis', '94' => '94 Val de Marne', '95' => '95 Oise', 'Languedoc-Roussillon' => 'Languedoc-Roussillon', 'Limousin' =>'Limousin', 'Lorraine' =>'Lorraine', 'Lorraine' =>'Lorraine', 'Midi-Pyrénées' =>'Midi-Pyrénées', 'Nord-Pas-de-Calais' =>'Nord-Pas-de-Calais', 'Pays de la Loire' =>'Pays de la Loire', 'Picardie' =>'Picardie', 'Poitou-Charentes' =>'Poitou-Charentes', 'Provence-Alpes-Côte d\'Azur' =>'Provence-Alpes-Côte d\'Azur', 'Rhône-Alpes' =>'Rhône-Alpes',  ), 'multiple' => false,))
            ->add('title')
            ->add('modele')
            ->add('categorie', 'choice', array('choices'  => array('Eco' => 'Eco (508, C5, Ds5... UerX)', 'Berline / Limousine' => 'Berline / Limousine', 'Van' => 'Van'), 'multiple' => false,))
            ->add('annee', 'choice', array('label'  => 'Année', 'choices' =>  array_combine( \range(date('Y')-8, date('Y')), \range(date('Y')-8, date('Y')))))
            ->add('mois', 'choice', array('label'  => 'Mois', 'choices' =>  array('Janv' => 'Janv', 'Fev' => 'Fev', 'Mars' => 'Mars', 'Avr' => 'Avr', 'Mai' => 'Mai',
                                              'Juin' => 'Juin', 'Juil' => 'Juil', 'Aout' => 'Aout', 'Sep' =>'Sep', 'Oct'=>'Oct', 'Nov' =>'Nov', 'Dec' => 'Dec')))


             ->add('boitevitesse', 'choice', array('choices'  => array('Automatique' => 'Automatique', 'Manuelle' => 'Manuelle'), 'expanded' => true,))
            ->add('energie', 'choice', array('choices'  => array('Diesel' => 'Diesel', 'Hybride' => 'Hybride', 'Essence' => 'Essence', 'Electrique' => 'Electrique', 'Hybride' => 'Hybride'), 'expanded' => true,))
            ->add('kilometres', 'text' ,  array( 'required' => true,))
            ->add('interieur', 'choice', array('choices'  => array('Cuir' => 'Cuir', 'Semi-Cuir' => 'Semi-Cuir', 'Tissu' => 'Tissu'), 'expanded' => true,))

            ->add('assurance','checkbox',  array( 'required' => false,))
            ->add('locjour','checkbox',  array( 'required' => false,))
            ->add('pricejour', 'text' ,  array( 'required' => false,))
            ->add('pricehebdo', 'text' ,  array( 'required' => false,))
            ->add('lochebdo','checkbox',  array( 'required' => false,))
            ->add('pricemensuel', 'text' ,  array( 'required' => false,))
            ->add('locmensuel','checkbox',  array( 'required' => false,))
            ->add('doublagebool','checkbox',  array( 'required' => false,))
           // ->add('valid')
           //->add('doublage')
            
            ->add('kilometremax')
            
            
            
            ->add('comments','textarea', array('required' => false, 'attr' => array('cols' => 40, 'rows' => 10)  ))


          ->add('images', 'collection', array(
        'type'         => new ImageType(),
        'allow_add'    => true,
        'allow_delete' => true,
        'by_reference' => false,

      ))


            ->add('save', 'submit')
        ;
        
    }
    
    public function getParent()
  {
    return new AdvertType();
  }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vtc_annoncebundle_advert_edit';
    }
    
}
