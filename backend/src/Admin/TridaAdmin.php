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
use Sonata\Form\Type\DateRangePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use App\Entity;
use App\AdminFilter\JsonListFilter;

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
// fixme
            ->add('vlastnosti', StringFilter::class /*JsonListFilter::class*/, array(
                'field_type' => Type\ChoiceType::class,
                'field_options' => array(
                    'choices' => $this->loadVlastnostiChoices(),
                    'multiple' => true,
                ))
            )
            ->add('idZarizeni.jmeno')
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni.idReditelstvi.idOkres')
            ->add('idZarizeni.idReditelstvi.idOkres.idKraj')
            ->add('idZarizeni.idSkolaTyp')
            ->add('idZarizeni.idJazyk')
            ->add('idZarizeni.aktivni')
            ->add('datumCasAktualizace', DateRangeFilter::class, array(
                'global_search'=>false,
                'field_type'=>DateRangePickerType::class,
            ))

            ->add('id')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('idZarizeni.jmeno')
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni.idReditelstvi.idOkres')
            ->add('idZarizeni.idReditelstvi.idOkres.idKraj')
            ->add('idZarizeni.idSkolaTyp')
            ->add('idZarizeni.idJazyk')
            ->add('idZarizeni.aktivni')
            ->add('vlastnosti')
            ->add('aktualniKapacitaUkVolno')
            ->add('aktualniKapacitaUkObsazeno')
            ->add('poznamkaCz')
            ->add('poznamkaUk')
            ->add('datumCasAktualizace')
        ;
    }

    /**
    * @param ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idZarizeni.idReditelstvi')
            ->add('idZarizeni')
            ->add('vlastnosti', FieldDescriptionInterface::TYPE_CHOICE, array(
                'multiple' => true,
                'choices' => array_flip($this->loadVlastnostiChoices()),
            ))
            ->add('aktualniKapacitaUkVolno', null, array(
                'editable' => true,
            ))
            ->add('aktualniKapacitaUkObsazeno', null, array(
                'editable' => true,
            ))
            ->add('poznamkaCz', null, array(
                'editable' => true,
            ))
            ->add('poznamkaUk', null, array(
                'editable' => true,
            ))
            ->add('datumCasAktualizace')
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
        $subject = $this->getSubject();

        if (!$embedded) {
            $formMapper
                ->add('idZarizeni');
        }
        $formMapper
            ->add('vlastnosti', Type\ChoiceType::class, array(
                'multiple' => true,
                'required' => true,
                'choices' => $this->loadVlastnostiChoices($subject),
            ))
            ->add('aktualniKapacitaUkVolno', null, array(
                'required' => false,
            ))
            ->add('aktualniKapacitaUkObsazeno', null, array(
                'required' => false,
            ))
            ->add('poznamkaCz')
            ->add('poznamkaUk')

        ;
    }

    protected function loadVlastnostiChoices(Entity\Trida $trida = null): array
    {
        $result = array();
        $em = $this->getModelManager()->getEntityManager(Entity\TridaVlastnosti::class);
        $list = $em->getRepository(Entity\TridaVlastnosti::class)->findBy(array('aktivni' => true), array('id' => 'ASC'));
        $tridaVlastnosti = $trida ? $trida->getIdZarizeni()->getIdSkolaTyp()->getTridyVlastnosti() : null;

        foreach ($list as $item) {
            if ($trida && is_array($tridaVlastnosti) && count($tridaVlastnosti) > 0) {
                // filter by list if present
                foreach ($tridaVlastnosti as $vlastnost) {
                    if ($vlastnost == $item->getId()) {
                        $result[$item->getJmenoCz()] = $item->getId();
                        break;
                    }
                }
            } else {
                // include always
                $result[$item->getJmenoCz()] = $item->getId();
            }
        }
        return $result;
    }

}

