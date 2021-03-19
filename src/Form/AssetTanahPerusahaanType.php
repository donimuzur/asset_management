<?php

namespace App\Form;

use App\Entity\AssetTanahPerusahaan;
use App\Entity\MasterWilayah;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetTanahPerusahaanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('luasan',null,['required'=>true])
            ->add('lokasi',HiddenType::class,['required'=>false])
            ->add('provinsi')
            ->add('kabupaten_kota',null,['required'=>false])
            ->add('kecamatan',null,['required'=>false])
            ->add('desa',null,['required'=>false])
            ->add('no_shm',null,['required'=>true])
            ->add('nama_pemilik',null,['required'=>false])
            ->add('Status',ChoiceType::class,[
                'choices'  => [
                    'C&C' => 'Clean And Clear',
                    'C not clear' => 'Clean not clear'
                    ],
                ],['required'=>true])
            ->add('keterangan',TextareaType::class,['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssetTanahPerusahaan::class,
        ]);
    }
}
