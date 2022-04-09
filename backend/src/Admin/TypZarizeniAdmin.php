<?php

namespace App\Admin;

use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Object\Metadata;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;

class TypZarizeniAdmin extends AbstractAdmin
{
    /** $var LoggerInterface $logger */
    public $logger;

    public function __construct($code, $class, $baseControllerName, LoggerInterface $logger)
    {
        $this->logger = $logger;

        return parent::__construct($code, $class, $baseControllerName);
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
            $collection->remove('delete');
            $collection->remove('batch');
            $collection->remove('create');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('idmsmt')
            ->add('tridyVlastnosti', StringFilter::class, array(
                'field_type' => Type\ChoiceType::class,
                'field_options' => array(
                    'choices' => $this->loadVlastnostiChoices(),
                )),
            )
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('idmsmt')
            ->add('jmenocz')
            ->add('jmenouk')
        ;
    }

    /**
    * @param ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('idmsmt')
            ->add('jmenocz')
            ->add('jmenouk')
            ->add('aktivni')
            ->add('tridyVlastnosti', FieldDescriptionInterface::TYPE_CHOICE, array(
                'multiple' => true,
                'choices' => array_flip($this->loadVlastnostiChoices()),
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
            //      'delete' => array()
            )))
    ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('idmsmt', Type\TextType::class, array(
                'required' => false,
            ))
            ->add('jmenoCz')
            ->add('jmenoUk')
            ->add('aktivni')
            ->add('tridyVlastnosti', Type\ChoiceType::class, array(
                'multiple' => true,
                'required' => false,
                'choices' => $this->loadVlastnostiChoices(),
            ))
        ;
    }

    protected function loadVlastnostiChoices(): array
    {
        $result = array();
        $em = $this->getModelManager()->getEntityManager(\App\Entity\TridaVlastnosti::class);

        $list = $em->getRepository(\App\Entity\TridaVlastnosti::class)->findBy(array('aktivni' => true), array('id' => 'ASC'));

        $choices = array();

        foreach ($list as $item) {
            $result[$item->getJmenoCz()] = $item->getId();
        }
        return $result;
    }
}

