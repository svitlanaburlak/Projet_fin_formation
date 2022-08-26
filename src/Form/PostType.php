<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('image', FileType::class,
                    ['mapped' => false,
                    'constraints' => [
                        new File([
                            // 'maxSize' => '1024k',
                            // 'mimeTypes' => [
                            //     'application/png',
                            //     'application/jpg',
                            // ],
                            'mimeTypesMessage' => 'Please upload a valid image',
                        ])
                    ],])
            ->add('content')
            ->add('date2', DateType::class,
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

        // $builder->get('date')
        // ->addModelTransformer(new CallbackTransformer(
        //     function ($dateToObject) {
        //         // transform the string to a DateTime object
        //         // return count($rolesArray)? $rolesArray[0]: null;
        //     },
        //     function ($dateTiString) {
        //         // transform the DateTime object back to a string
        //         // return $rolesString;
        //     }
        // ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
