<?php
/**
 * Created by PhpStorm.
 * User: servir
 * Date: 9/01/15
 * Time: 03:21 PM
 */

namespace TS\WSBundle\Form\Type;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class WSType
 * @package TS\WSBundle\Form\Type
 */
class WSType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario', 'text', array('required' => false))
            ->add('id', null, array('required' => false,))
            ->add('codigo_pais', null, array('required' => false,))// codpai
            ->add('codigo_agencia', null, array('required' => false,))// codagencia
            ->add('codigo_persona', null, array('required' => false,))// codper
            ->add('nombre_presona', null, array('required' => false,))// nomper
            ->add('nombre_corto', null, array('required' => false,))// ncper;
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Servir\WSConexionFactorhBundle\Model\Personal',
                'csrf_protection' => false,
                'allow_extra_fields' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}