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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;

class TridaAdmin extends AbstractAdmin
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
            ->add('id')
            ->add('idZarizeni.jmeno')
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni.idReditelstvi.idOkres')
            ->add('idZarizeni.idReditelstvi.idOkres.idKraj')
            ->add('idZarizeni.idSkolaTyp')
            ->add('idZarizeni.idJazyk')
            ->add('idZarizeni.aktivni')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('idZarizeni.jmeno')
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni.idReditelstvi.idOkres')
            ->add('idZarizeni.idReditelstvi.idOkres.idKraj')
            ->add('idZarizeni.idSkolaTyp')
            ->add('idZarizeni.idJazyk')
            ->add('idZarizeni.aktivni')
        ;
    }

    /**
    * @param ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni')
            ->add('vlastnosti', FieldDescriptionInterface::TYPE_CHOICE, array(
                'multiple' => true,
                'choices' => array_flip($this->loadVlastnostiChoices()),
            ))
            ->add('aktualniKapacitaUkObsazeno')
            ->add('aktualniKapacitaUkVolno')
            ->add('poznamkaCz')
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
        $embedded = $this->hasParentFieldDescription();

        if (!$embedded) {
            $formMapper
                ->add('idZarizeni');
        }
        $formMapper
            ->add('aktualniKapacitaUkObsazeno', null, array(
                'required' => true,
            ))
            ->add('aktualniKapacitaUkVolno', null, array(
                'required' => true,
            ))
            ->add('poznamkaCz')
            ->add('poznamkaUk')
            ->add('vlastnosti', Type\ChoiceType::class, array(
                'multiple' => true,
                'required' => true,
                'choices' => $this->loadVlastnostiChoices(),
            ))

        ;
    }

    protected function loadVlastnostiChoices(): array
    {
        $result = array();
        $em = $this->getModelManager()->getEntityManager(\App\Entity\TridaVlastnosti::class);

        $list = $em->getRepository(\App\Entity\TridaVlastnosti::class)->findBy(array('aktivni' => true), array(/* TODO sort 'sortidx' => 'ASC'*/));

        $choices = array();

        foreach ($list as $item) {
            $result[$item->getJmenoCz()] = $item->getId();
        }
        return $result;
    }

}

