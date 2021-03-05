<?php

namespace App\Form;

use App\Entity\AssetKendaraanMotor;
use App\Entity\AttachmentAssetKendaraanMotor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AttachmentAssetKendaraanMotorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attach_desc', HiddenType::class)
            ->add('attach_filename', HiddenType::class)
            ->add('attach_size', HiddenType::class)
            ->add('attach_attachment', HiddenType::class)
            ->add('attached_time', HiddenType::class)
            ->add('attached_by', HiddenType::class)
            ->add('assetKendaraanMotor',AssetKendaraanMotorType::class)
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AttachmentAssetKendaraanMotor::class,
        ]);
    }
}
