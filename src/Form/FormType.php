<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


use App\Entity\Event;
use App\Entity\User;

use App\Entity\Place;
use App\Entity\Category;

use App\Entity\Participation;



class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            
            ->add('createdAt', DateTimeType::class ,
            array(
                'widget' => 'single_text'
            )) 

            ->add('startAt' , DateTimeType::class,
            array(
                'widget' => 'single_text'
            ))
            
            ->add('endAt', DateTimeType::class,
            array(
                'widget' => 'single_text'
            ))

            ->add('content')
            ->add('price')
            ->add('poster')
            ->add('place', EntityType::class ,array( 
                  'class' => Place::class,
                  'choice_label' => 'name'
                  )) 

             ->add('categories', EntityType::class ,array( 
                  'class' => Category::class,
                  'choice_label' => 'name',
                  'expanded'  => true,
                  'multiple'  => true
                  ))
             
             ->add('owner', EntityType::class ,array( 
                'class' => User::class,
                'choice_label' => 'username',
             ));  
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
