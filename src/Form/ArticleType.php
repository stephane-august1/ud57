<?php

namespace App\Form;

use App\Entity\Article;


use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', CKEditorType::class)
            ->add('imagename')
            ->add('imageplace', TextType::class)

            ->add('imageFile', VichImageType::class)
            /*, array(
                'label' => 'Charger une image',
                'download_link' => true,
                'download_label'    => true,
                'image_uri' => true,
                'download_uri' => true,

                'allow_delete' => true,
                // 'property_path' => true,
                'delete_label'          => 'Effacer l\'ancienne image ?'

            ))*/


            //en version date sans heure
            ->add('updatedat',  DateType::class, [
                'widget' => 'choice',

                // 'date_widget' => 'single_text',
                // 'format' => 'dd-MM-YY',
                //'html5' => true,
                //'years' => range(2019, 2050)

            ])
            //en version datetime
            /* ->add('updatedat',  DateTimeType::class, [
                'date_widget' => 'single_text'
            ])*/
            ->add('submit', SubmitType::class, [
                'label' => 'envoyer',
                'attr' => ['class' => 'btn btn-outline-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,

        ]);
    }
}
