<?php

namespace App\Model;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//Création d'un formulaire pour le traitement du fichier de transactions Kraken.
class TransactionKrakenFormModel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('csvFile', FileType::class, [
            'label' => 'Fichier CSV',
            'required' => true,
            'mapped' => false, // Le fichier n'est pas lié directement à une entité
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }

}