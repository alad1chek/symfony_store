<?php

namespace Neklesa\StoreBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorylinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class'=>'NeklesaStoreBundle:Category',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('u');
                },
                'choice_label'=>'name'
            ])
            ->add('product', EntityType::class,[
                'class'=>'NeklesaStoreBundle:Product',
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('u');
                },
                'choice_label'=>'name'
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Neklesa\StoreBundle\Entity\Categorylink'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'neklesa_storebundle_categorylink';
    }


}
