<?php

namespace App\Form;

use App\Entity\AssetKendaraanMobil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetKendaraanMobilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tahun')
            ->add('Type')
            ->add('Pic')
            ->add('Status',ChoiceType::class,[
                'choices'  => [
                    'Leasing' => 'Leasing',
                    'Rent' => 'Rent',
                    'Owning' => 'Owning',
                ],
            ])
            ->add('Keterangan', TextareaType::class, ['required'=>false])
            ->add('PoliceNumber')
            ->add('EngineNumber')
            ->add('ChasisNumber')
            ->add('Manufacturer')
            ->add('Model')
            ->add('Series')
            ->add('Color')
            ->add('Transmission',ChoiceType::class,[
                'choices'  => [
                    'Manual' => 'Manual',
                    'Automatic' => 'Automatic',
                ],
            ])
            ->add('FuelType',ChoiceType::class,[
                'choices'  => [
                    'Gasoline' => 'Gasoline',
                    'Diesel' => 'Diesel',
                    'Hybrid' => 'Hybrid',
                ],
            ])
            ->add('Airbag', CheckboxType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssetKendaraanMobil::class,
        ]);
    }
}
