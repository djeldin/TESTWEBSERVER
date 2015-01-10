<?php

namespace TS\WSBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WsType extends BaseAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id',null, array('required' => false,));
        $builder->add('telefono');
        $builder->add('status', 'choice', array(
            'choices' => array('ACTIVO' => 'ACTIVO', 'INACTIVO' => 'ACTIVO', 'BAJA' => 'ACTIVO')
        ));
        $builder->add('marca');
        $builder->add('modelo');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'TS\WSBundle\Model\Ws',
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
        return 'ws';
    }
}
