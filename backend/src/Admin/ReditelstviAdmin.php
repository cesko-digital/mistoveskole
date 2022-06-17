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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;

class ReditelstviAdmin extends AbstractAdmin
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
//            $collection->remove('batch');
//            $collection->remove('create');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('redIzo')
            ->add('obec')
            ->add('idOkres')
            ->add('idOkres.idKraj')
            ->add('idZrizovatel')
            ->add('id')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('redIzo')
            ->add('obec')
            ->add('idOkres')
            ->add('idOkres.idKraj')
            ->add('zarizeni')
        ;
    }

    /**
    * @param ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('redIzo', 'text')
            ->add('redZkracenyNazev')
            ->add('obec')
            ->add('idOkres')
            ->add('idOkres.idKraj')
            ->add('zarizeni')
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
            ->with('Info', array('class' => 'col-md-6'))
            ->add('redIzo')
            ->add('redPlnyNazev')
            ->add('datovaSchranka')
            ->add('idZrizovatel')
            ->end()
            ->with('Adresa', array('class' => 'col-md-6'))
            ->add('idOkres')
            ->add('idOrp')
            ->add('obec')
            ->add('redAdresa1')
            ->add('redAdresa2')
            ->add('redAdresa3')
            ->add('redRuianKod', null, array(
                'disabled' => true,
            ))
            ->add('gpsLat', Type\NumberType::class, array(
                'scale' => 6,
                'required' => false,
            ))
            ->add('gpsLon', Type\NumberType::class, array(
                'scale' => 6,
                'required' => false,
            ))
            ->end()
        ;
    }
}

