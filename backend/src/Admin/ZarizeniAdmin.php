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
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use App\Entity;

class ZarizeniAdmin extends AbstractAdmin
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
            ->add('izo')
            ->add('idReditelstvi.redIzo')
            ->add('idReditelstvi.redPlnyNazev')
            ->add('mistoAdresa3')
            ->add('idReditelstvi.idOkres')
            ->add('idReditelstvi.idOkres.idKraj')
            ->add('idSkolaTyp')
            ->add('idZrizovatel')
            ->add('idJazyk')
            ->add('aktivni')
            ->add('idReditelstvi')
            ->add('kapacitaUkVolnoCelkem')
            ->add('kapacitaUkObsazenoCelkem')
            ->add('skolaKapacita')
            ->add('kapacitaUk2223')
            ->add('id')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('izo')
            ->add('idReditelstvi.redIzo')
            ->add('idReditelstvi.idOkres')
            ->add('idReditelstvi.idOkres.idKraj')
            ->add('idSkolaTyp')
            ->add('idJazyk')
            ->add('aktivni')
            ->add('idReditelstvi')
        ;
    }

    /**
    * @param ListMapper $listMapper
    */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('izo', 'text')
            ->add('idReditelstvi')
            ->add('idReditelstvi.idOkres')
            ->add('idReditelstvi.idOkres.idKraj')
            ->add('skolaPlnyNazev')
            ->add('idJazyk')
            ->add('aktivni', null, array(
                'editable' => true,
            ))
            ->add('kapacitaUkVolnoCelkem')
            ->add('kapacitaUkObsazenoCelkem')
            ->add('skolaKapacita')
            ->add('kapacitaUk2223')
            ->add('trida2r', null, array(
                'label' => '2r'
            ))
            ->add('trida3r', null, array(
                'label' => '3r'
            ))
            ->add('trida4r', null, array(
                'label' => '4r'
            ))
            ->add('trida5r', null, array(
                'label' => '5r'
            ))
            ->add('trida6r', null, array(
                'label' => '6r'
            ))
            ->add('trida7r', null, array(
                'label' => '7r'
            ))
            ->add('trida8r', null, array(
                'label' => '8r'
            ))
            ->add('trida9r', null, array(
                'label' => '9r'
            ))
            ->add('trida10r', null, array(
                'label' => '10r'
            ))
            ->add('trida11r', null, array(
                'label' => '11r'
            ))
            ->add('trida12r', null, array(
                'label' => '12r'
            ))
            ->add('trida13r', null, array(
                'label' => '13r'
            ))
            ->add('trida14r', null, array(
                'label' => '14r'
            ))
            ->add('trida15r', null, array(
                'label' => '15r'
            ))
            ->add('trida16r', null, array(
                'label' => '16r'
            ))
            ->add('trida17r', null, array(
                'label' => '17r'
            ))
            ->add('trida18r', null, array(
                'label' => '18r'
            ))
/* unused now
            ->add('volneTridy', FieldDescriptionInterface::TYPE_CHOICE, array(
                'multiple' => true,
                'choices' => array_flip($this->loadVlastnostiChoices()),
            ))
*/
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
            ->with('Zařízení', array('class' => 'col-md-6'))
            ->add('idReditelstvi')
            ->add('izo')
            ->add('skolaPlnyNazev')
            ->add('idSkolaTyp')
            ->add('idJazyk')
            ->add('aktivni')
            ->add('skolaKapacita')
            ->add('kapacitaUkVolnoCelkem', null, array(
                'disabled' => true,
            ))
            ->add('kapacitaUkObsazenoCelkem', null, array(
                'disabled' => true,
            ))
            ->add('kapacitaUk2223')
            ->add('DatumAktualizaceString', null, array(
                'disabled' => true,
            ))
            ->end()
            ->with('Kontakt pro rodiče', array('class' => 'col-md-6'))
            ->add('kontaktJmeno')
            ->add('kontaktEmail')
            ->add('kontaktTelefon')
            ->add('kontaktWww')
            ->end()
            ->with('Adresa výuky', array('class' => 'col-md-6'))
            ->add('mistoAdresa1')
            ->add('mistoAdresa2')
            ->add('mistoAdresa3')
            ->add('mistoRuianKod', null, array(
                'disabled' => true,
            ))
            ->end()
            ->with('Poznámky zařízení', array('class' => 'col-md-12'))
            ->add('poznamkaCz')
            ->add('poznamkaUk')
            ->end()
            ->with('Třídy', array('class' => 'col-md-12'))
            ->add('tridy', CollectionType::class, array(
                   'by_reference' => true,
                   'required'=>true,
                   'type_options' => array(
                       // Prevents the "Delete" option from being displayed
                       'delete' => false,
                   ),
               ), array(
                   'cascade_validation' => true,
                   'edit' => 'inline',
                   'inline' => 'table',
                   'order' => 'vlastnosti'
             ))
            ->end()
        ;
    }

    protected function configureExportFields(): array
    {
        // undocumented way of customize export headers, see e.g. https://stackoverflow.com/questions/34342811/can-header-labels-be-translated-in-sonata-admin-bundle-export-feature
        // new idea, but not implemented https://github.com/sonata-project/SonataAdminBundle/issues/5854
        $fieldsArray = array(
            'id'                       => 'Id',
            'reditelstvi.redPlnyNazev' => 'idReditelstvi.redPlnyNazev',
            'reditelstvi.redZkracenyNazev' => 'idReditelstvi.redZkracenyNazev',
            'reditelstvi.okres'        => 'idReditelstvi.idOkres.jmenoCz',
            'reditelstvi.kraj'         => 'idReditelstvi.idOkres.idKraj.jmenoCz',
            'reditelstvi.obec'         => 'idReditelstvi.obec',
            'reditelstvi.redIzo'       => 'idReditelstvi.redIzo',
            'izo'                      =>  'Izo',
            'skolaPlnyNazev'           => 'SkolaPlnyNazev',
            'typSkoly'                 => 'idSkolaTyp',
            'jazykSkoly'               => 'idJazyk',
//            'SkolaKapacita',
//            'Aktivni',
            'mistoAdresa1'             => 'MistoAdresa1',
            'mistoAdresa2'             => 'MistoAdresa2',
            'mistoAdresa3'             => 'MistoAdresa3',
            'mistoRuianKod'            => 'MistoRuianKod',
            'kontaktEmail1'            => 'KontaktEmail1',
            'kontaktEmail2'            => 'KontaktEmail2',
            'kontaktTelefon1'          => 'KontaktTelefon1',
            'kontaktTelefon2'          => 'KontaktTelefon2',
            'kontaktJmeno'             => 'KontaktJmeno',
            'kontaktWww1'              => 'KontaktWww1',
            'kontaktWww2'              => 'KontaktWww2',
//            'KapacitaUkObsazenoCelkem',
            'kapacitaVolno'            => 'KapacitaUkVolnoCelkem',
            'poznamkaCz'               => 'PoznamkaCz',
            'poznamkaUk'               => 'PoznamkaUk',
            'volneTridy'               => 'VolneTridy',
            'datumAktualizace'      => 'DatumAktualizaceString',
        );

        return $fieldsArray;
    }

    protected function loadVlastnostiChoices(): array
    {
        $result = array();
        $em = $this->getModelManager()->getEntityManager(Entity\TridaVlastnosti::class);
        $list = $em->getRepository(Entity\TridaVlastnosti::class)->findBy(array('aktivni' => true), array('id' => 'ASC'));

        foreach ($list as $item) {
                // include always
                $result[$item->getJmenoCz()] = $item->getId();
        }
        return $result;
    }

}

