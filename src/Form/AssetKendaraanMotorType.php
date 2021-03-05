<?php

namespace App\Form;

use App\Entity\AssetKendaraanMotor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetKendaraanMotorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Tahun')
            ->add('PoliceNumber')
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
            ->add('EngineNumber')
            ->add('ChasisNumber')
            ->add('Manfucaturer')
            ->add('Model')
            ->add('Series')
            ->add('Color')
            ->add('Transmission',ChoiceType::class,[
                'choices'  => [
                    'Manual' => 'Manual',
                    'Automatic' => 'Automatic',
                    'Hybrid' => 'Hybrid',
                ],
            ])
            ->add('FuelType',ChoiceType::class,[
                'choices'  => [
                    'Gasoline' => 'Gasoline',
                    'Diesel' => 'Diesel'
                ],
            ])
            ->add('Airbag', HiddenType::class, ['required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssetKendaraanMotor::class,
        ]);
    }
}
