<?php

namespace App\Form;

use App\Entity\AssetUser;
use App\Entity\AssetUserRole;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AssetUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Id',HiddenType::class)
            ->add('UserRoleId', EntityType::class, [
                'class'=> AssetUserRole::class,
                'choice_label'=>'DisplayName',
                'choice_value' => 'Id'
            ])
            ->add('FullName')
            ->add('UserName')
            ->add('UserPassword', PasswordType::class)
            ->add('Deleted', CheckboxType::class,['required'=>false])
            ->add('Status', CheckboxType::class)
            ->add('CreatedDate', HiddenType::class)
            ->add('CreatedBy',HiddenType::class)
            ->add('ModifiedDate',HiddenType::class)
            ->add('ModifiedBy',HiddenType::class)
        ;

        $builder
            ->get('CreatedDate')
            ->addModelTransformer(new DateTimeToStringTransformer());

        $builder
            ->get('ModifiedDate')
            ->addModelTransformer(new DateTimeToStringTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssetUser::class,
        ]);
    }
}
