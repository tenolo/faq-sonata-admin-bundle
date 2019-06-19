<?php

namespace Tenolo\Bundle\FAQAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CategoryAdmin
 *
 * @package Tenolo\Bundle\FAQAdminBundle\Admin
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class CategoryAdmin extends AbstractAdmin
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

        $form->add('content', TextareaType::class, [
            'label'       => 'Inhalt',
            'required' => false,
        ]);

        $form->add('enable', CheckboxType::class, [
            'label'    => 'Aktivieren',
            'required' => false,
        ]);

        $form->add('sortOrder', NumberType::class, [
            'label' => 'Sortierung',
            'required' => false,
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
        $listMapper->add('enable');
        $listMapper->add('sortOrder');
        $listMapper->add('slug');
    }
}
