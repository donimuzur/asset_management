<?php

namespace App\Form;

use App\Entity\BerkasPerusahaan;
use App\Entity\MasterPerusahaan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BerkasPerusahaanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deskripsi')
            ->add('perusahaan', EntityType::class, [
                'class'=> MasterPerusahaan::class,
                'choice_label'=>'nama_perusahaan',
                'choice_value' => 'id'
            ])
            ->add('attach_filename',FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BerkasPerusahaan::class,
        ]);
    }
}
