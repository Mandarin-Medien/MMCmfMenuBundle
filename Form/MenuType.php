<?php

namespace MandarinMedien\MMCmfMenuBundle\Form;

use MandarinMedien\MMCmfMenuBundle\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('parent')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Menu::class
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'mandarinmedien_mmcmfmenubundle_menu';
    }
}
