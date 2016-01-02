<?php

namespace VTC\AnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('categorie', 'choice', array('choices'  => array('' => 'Categorie','Eco' => 'Eco (508, C5, Ds5... UerX)', 'Berline / Limousine' => 'Berline / Limousine', 'Van' => 'Van'), 'multiple' => false, 'required' => false,))
            ->add('dept', 'choice', array('choices'  => array('' => 'Departement', '75' => '75 Paris', '77' => '77 Seine et Marne', '78' => '78 Yvelines', '91' => '91 Essonne', '92' => '92 Haut de Seine', '93' => '93 Seine saint Denis', '94' => '94 Val de Marne', '95' => '95 Oise'), 'multiple' => false, 'required' => false,))
            ->add('annee', 'choice', array('choices' =>  array_combine( \range(date('Y')-8, date('Y')), \range(date('Y')-8, date('Y')))))
            ->add('kmsmin', 'choice', array('choices'  => array('' => 'KM min', '0' => '0', '15 000' => '15 000', '25 000' => '25 000', '40 000' => '40 000', '55 000' => '55 000', '65 000' => '65 000', '75 000' => '75 000', '100 000' => '100 000', '125 000' => '125 000', '150 000' => '150 000', '175 000' => '175 000', '200 000' => '200 000',), 'multiple' => false, 'required' => false,))
            ->add('kmsmax', 'choice', array('choices'  => array('' => 'KM max', '0' => '0', '15 000' => '15 000', '25 000' => '25 000', '40 000' => '40 000', '55 000' => '55 000', '65 000' => '65 000', '75 000' => '75 000', '100 000' => '100 000', '125 000' => '125 000', '150 000' => '150 000', '175 000' => '175 000', '200 000' => '200 000',), 'multiple' => false, 'required' => false,))
            ->add('energie', 'choice', array('choices'  => array('' => 'Energie', 'Diesel' => 'Diesel', 'Hybride' => 'Hybride', 'Essence' => 'Essence', 'Electrique' => 'Electrique', 'Hybride' => 'Hybride'), 'multiple' => false, 'required' => false,))
            ->add('boitevitesse', 'choice', array('choices'  => array('' => 'Boite de Vitesse','Automatique' => 'Automatique', 'Manuelle' => 'Manuelle'), 'multiple' => false,'required' => false,))
            

            ->add('locjour', 'checkbox',  array( 'required' => false,))
            ->add('lochebdo', 'checkbox', array( 'required' => false,))
            ->add('locmensuel', 'checkbox', array( 'required' => false,))
            ->add('doublagebool', 'checkbox', array( 'required' => false,))

            ->add('Chercher', 'submit')
        ;
    }
    
   
    /**
     * @return string
     */
    public function getName()
    {
        return 'vtc_annoncebundle_search';
    }
}
