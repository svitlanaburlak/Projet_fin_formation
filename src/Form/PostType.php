<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('image')
            ->add('content')
            ->add('date', DateType::class,
                [ 'label' => 'Date d\'événement',
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => true,
                ])
            ->add('address')
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Active' => 1,
                    'Inactif' => 0],
                    'expanded' => true,
                'multiple' => false,
                ])
            ->add('updatedAt', DateType::class,
                [ 'label' => 'Date de modification',
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => true,
                ])
            ->add('category',
                EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'multiple' => true, 
                    'expanded' => true,
                    'required' => false,] 
                )
            ->add('city',
                EntityType::class, [
                    'class' => City::class,
                    'choice_label' => 'name',
                    'multiple' => false, 
                    'expanded' => true,
                    'required' => true] 
                )
            ->add('user', 
                EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'email',
                    'multiple' => false, 
                    'expanded' => false,
                    'required' => true] 
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
