<?php

namespace Tenolo\Bundle\FAQAdminBundle\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Tenolo\Bundle\FAQBundle\Entity\Category;

/**
 * Class QuestionAdmin
 *
 * @package Tenolo\Bundle\FAQAdminBundle\Admin
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class QuestionAdmin extends AbstractAdmin
{

    /**
     * @inheritDoc
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name', TextType::class, [
            'label'       => 'Name',
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        $form->add('content', CKEditorType::class, [
            'label'       => 'Inhalt',
            'constraints' => [
                new NotBlank(),
            ],
            'config'      => ['toolbar' => 'standard'],
        ]);

        $form->add('enable', CheckboxType::class, [
            'label'    => 'Aktivieren',
            'required' => false,
        ]);

        $form->add('top', CheckboxType::class, [
            'label'    => 'Top-Frage',
            'help'     => 'Diese Frage wird direkt auf der ersten Seite der FAQ angezeigt',
            'required' => false,
        ]);

        $form->add('sortOrder', NumberType::class, [
            'required' => false,
            'label'    => 'Sortierung',
        ]);

        $form->add('category', EntityType::class, [
            'required' => false,
            'class'    => Category::class,
            'label'    => 'Kategorie',
        ]);

        $form->add('publishAt', DateTimeType::class, [
            'required' => false,
            'label'    => 'Veröffentlichen am',
        ]);

        $form->add('expiresAt', DateTimeType::class, [
            'required' => false,
            'label'    => 'Läuft aus am',
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show->add('name');
    }

    /**
     * @inheritdoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    /**
     * @inheritdoc
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
        $listMapper->add('category.name');
        $listMapper->add('enable');
        $listMapper->add('sortOrder');
        $listMapper->add('slug');
        $listMapper->add('publishAt');
        $listMapper->add('expiresAt');
    }
}
