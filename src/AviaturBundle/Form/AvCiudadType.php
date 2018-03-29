<?php

namespace AviaturBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvCiudadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre',null, array(
                    'required' => true,
                    'attr' =>
                    array(
                        'placeholder' => 'Nombre Ciudad' ,  'maxlength' => '255'
            )))->add('descripcion',null, array(
                    'required' => true,
                    'attr' =>
                    array(
                        'placeholder' => 'Descripción Ciudad' , 'maxlength' => '255'
            )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AviaturBundle\Entity\AvCiudad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aviaturbundle_avciudad';
    }


}
