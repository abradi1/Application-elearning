<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Enseignant;
use App\Entity\Apprenant;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('image',FileType::class,array('data_class'=> null, 'label' => 'Image','label' => false ))
            ->add('id_enseignant',EntityType::class, [
                'class'=> Enseignant::class,
                'choice_label'=>'prenom',
                'expanded'=>false,
                'multiple'=>false
            ])
            ->add('id_apprenant',EntityType::class, [
                'class'=> Apprenant::class,
                'choice_label'=>'prenom',
                'expanded'=>false,
                'multiple'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
