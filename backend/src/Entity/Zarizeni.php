<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * Zarizeni
 *
 * @ORM\Table(name="zarizeni", indexes={@ORM\Index(name="zarizeni_kapacita_ua_volno_celkem", columns={"kapacita_uk_volno_celkem"}), @ORM\Index(name="zarizeni_kapacita_ua_obsazeno_celkem", columns={"kapacita_uk_obsazeno_celkem"}), @ORM\Index(name="zarizeni_skola_plny_nazev", columns={"skola_plny_nazev"}), @ORM\Index(name="zarizeni_id_jazyk", columns={"id_jazyk"}), @ORM\Index(name="zarizeni_misto_adresa_3", columns={"misto_adresa_3"}), @ORM\Index(name="zarizeni_id_skola_typ", columns={"id_skola_typ"}), @ORM\Index(name="zarizeni_izo", columns={"izo"}), @ORM\Index(name="zarizeni_aktivni", columns={"aktivni"}), @ORM\Index(name="IDX_22357A70579B0BCA", columns={"id_reditelstvi"}), @ORM\Index(name="zarizeni_kapacita_uk_22_23", columns={"kapacita_uk_22_23"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Zarizeni
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="zarizeni_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="izo", type="integer", nullable=true)
     */
    private $izo;

    /**
     * @var string
     *
     * @ORM\Column(name="skola_plny_nazev", type="string", length=100, nullable=false)
     */
    private $skolaPlnyNazev;

    /**
     * @var int|null
     *
     * @ORM\Column(name="skola_kapacita", type="smallint", nullable=true)
     */
    private $skolaKapacita;

    /**
     * @var bool
     *
     * @ORM\Column(name="aktivni", type="boolean", nullable=false)
     */
    private $aktivni;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_email", type="string", length=100, nullable=true)
     */
    private $kontaktEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_telefon", type="string", length=100, nullable=true)
     */
    private $kontaktTelefon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_jmeno", type="string", length=100, nullable=true)
     */
    private $kontaktJmeno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_obsazeno_celkem", type="smallint", nullable=true)
     */
    private $kapacitaUkObsazenoCelkem;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_volno_celkem", type="smallint", nullable=true)
     */
    private $kapacitaUkVolnoCelkem;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_22_23", type="smallint", nullable=true)
     */
    private $kapacitaUk2223;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_www", type="string", length=255, nullable=true)
     */
    private $kontaktWww;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poznamka_cz", type="text", nullable=true)
     */
    private $poznamkaCz;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poznamka_uk", type="text", nullable=true)
     */
    private $poznamkaUk;

    /**
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_1", type="string", length=100, nullable=true)
     */
    private $mistoAdresa1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_2", type="string", length=100, nullable=true)
     */
    private $mistoAdresa2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_3", type="string", length=100, nullable=true)
     */
    private $mistoAdresa3;

    /**
     * @var int|null
     *
     * @ORM\Column(name="misto_ruian_kod", type="integer", nullable=true)
     */
    private $mistoRuianKod;

    /**
     * @var TypZarizeni
     *
     * @ORM\ManyToOne(targetEntity="TypZarizeni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_skola_typ", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSkolaTyp;

    /**
     * @var JazykVyuky
     *
     * @ORM\ManyToOne(targetEntity="JazykVyuky")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jazyk", referencedColumnName="id", nullable=false)
     * })
     */
    private $idJazyk;

    /**
     * @var Reditelstvi
     *
     * @ORM\ManyToOne(targetEntity="Reditelstvi", inversedBy="zarizeni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reditelstvi", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    private $idReditelstvi;

    /**
     * @var Trida[]
     *
     * @ORM\OneToMany(targetEntity="Trida", mappedBy="idZarizeni", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"vlastnosti" = "ASC"})
     */
    private $tridy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gps_lon", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $gpsLon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="gps_lat", type="decimal", precision=10, scale=6, nullable=true)
     */
    private $gpsLat;

    /**
     * @var int[] list of TridaVlastnosti.id, loaded with postLoad() event, no relation in db
     */
    private $tridaVlastnostiId;

    public function __construct()
    {
        $this->tridy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIzo(): ?int
    {
        return $this->izo;
    }

    public function setIzo(?int $izo): self
    {
        $this->izo = $izo;

        return $this;
    }

    public function getSkolaPlnyNazev(): ?string
    {
        return $this->skolaPlnyNazev;
    }

    public function setSkolaPlnyNazev(string $skolaPlnyNazev): self
    {
        $this->skolaPlnyNazev = $skolaPlnyNazev;

        return $this;
    }

    public function getSkolaKapacita(): ?int
    {
        return $this->skolaKapacita;
    }

    public function setSkolaKapacita(?int $skolaKapacita): self
    {
        $this->skolaKapacita = $skolaKapacita;

        return $this;
    }

    public function getAktivni(): ?bool
    {
        return $this->aktivni;
    }

    public function setAktivni(bool $aktivni): self
    {
        $this->aktivni = $aktivni;

        return $this;
    }

    public function getKontaktEmail(): ?string
    {
        return $this->kontaktEmail;
    }

    public function setKontaktEmail(?string $kontaktEmail): self
    {
        $this->kontaktEmail = $kontaktEmail;

        return $this;
    }

    public function getKontaktEmail1(): ?string
    {
        return $this->getValueSplit($this->getKontaktEmail(), 0);
    }
    public function getKontaktEmail2(): ?string
    {
        return $this->getValueSplit($this->getKontaktEmail(), 1);
    }

    public function getKontaktTelefon(): ?string
    {
        return $this->kontaktTelefon;
    }

    public function setKontaktTelefon(?string $kontaktTelefon): self
    {
        $this->kontaktTelefon = $kontaktTelefon;

        return $this;
    }
    public function getKontaktTelefon1(): ?string
    {
        return $this->getValueSplit($this->getKontaktTelefon(), 0);
    }
    public function getKontaktTelefon2(): ?string
    {
        return $this->getValueSplit($this->getKontaktTelefon(), 1);
    }

    public function getKontaktJmeno(): ?string
    {
        return $this->kontaktJmeno;
    }

    public function setKontaktJmeno(?string $kontaktJmeno): self
    {
        $this->kontaktJmeno = $kontaktJmeno;

        return $this;
    }

    public function getKapacitaUkObsazenoCelkem(): ?int
    {
        return $this->kapacitaUkObsazenoCelkem;
    }

    public function setKapacitaUkObsazenoCelkem(?int $kapacitaUkObsazenoCelkem): self
    {
        $this->kapacitaUkObsazenoCelkem = $kapacitaUkObsazenoCelkem;

        return $this;
    }

    public function getKapacitaUkVolnoCelkem(): ?int
    {
        return $this->kapacitaUkVolnoCelkem;
    }

    public function setKapacitaUkVolnoCelkem(?int $kapacitaUkVolnoCelkem): self
    {
        $this->kapacitaUkVolnoCelkem = $kapacitaUkVolnoCelkem;

        return $this;
    }

    public function getKapacitaUk2223(): ?int
    {
        return $this->kapacitaUk2223;
    }

    public function setKapacitaUk2223(?int $kapacita): self
    {
        $this->kapacitaUk2223 = $kapacita;

        return $this;
    }


    public function getKontaktWww(): ?string
    {
        return $this->kontaktWww;
    }

    public function setKontaktWww(?string $kontaktWww): self
    {
        $this->kontaktWww = $kontaktWww;

        return $this;
    }

    // legacy export for umapa, TODO remove
    public function getKontaktWwwHref(): ?string
    {
        if (!($www = $this->getKontaktWww())) {
            return null;
        }
        $array = explode(',', $this->getKontaktWww());
        foreach ($array as &$item) {
            $item = trim($item);
            $item = '<a href="'.$item.'">'.$item.'</a>';
        }
        return implode('!', $array);
    }

    public function getKontaktWww1(): ?string
    {
        return $this->getValueSplit($this->getKontaktWww(), 0);
    }
    public function getKontaktWww2(): ?string
    {
        return $this->getValueSplit($this->getKontaktWww(), 1);
    }

    public function getPoznamkaCz(): ?string
    {
        return $this->poznamkaCz;
    }

    public function setPoznamkaCz(?string $poznamkaCz): self
    {
        $this->poznamkaCz = $poznamkaCz;

        return $this;
    }

    public function getPoznamkaUk(): ?string
    {
        return $this->poznamkaUk;
    }

    public function setPoznamkaUk(?string $poznamkaUk): self
    {
        $this->poznamkaUk = $poznamkaUk;

        return $this;
    }

    public function getMistoAdresa1(): ?string
    {
        return $this->mistoAdresa1;
    }

    public function setMistoAdresa1(?string $mistoAdresa1): self
    {
        $this->mistoAdresa1 = $mistoAdresa1;

        return $this;
    }

    public function getMistoAdresa2(): ?string
    {
        return $this->mistoAdresa2;
    }

    public function setMistoAdresa2(?string $mistoAdresa2): self
    {
        $this->mistoAdresa2 = $mistoAdresa2;

        return $this;
    }

    public function getMistoAdresa3(): ?string
    {
        return $this->mistoAdresa3;
    }

    public function setMistoAdresa3(?string $mistoAdresa3): self
    {
        $this->mistoAdresa3 = $mistoAdresa3;

        return $this;
    }

    public function getMistoRuianKod(): ?int
    {
        return $this->mistoRuianKod;
    }

    public function setMistoRuianKod(?int $mistoRuianKod): self
    {
        $this->mistoRuianKod = $mistoRuianKod;

        return $this;
    }

    public function getIdSkolaTyp(): ?TypZarizeni
    {
        return $this->idSkolaTyp;
    }

    public function setIdSkolaTyp(?TypZarizeni $idSkolaTyp): self
    {
        $this->idSkolaTyp = $idSkolaTyp;

        return $this;
    }

    public function getIdJazyk(): ?JazykVyuky
    {
        return $this->idJazyk;
    }

    public function setIdJazyk(?JazykVyuky $idJazyk): self
    {
        $this->idJazyk = $idJazyk;

        return $this;
    }

    public function getIdReditelstvi(): ?Reditelstvi
    {
        return $this->idReditelstvi;
    }

    public function setIdReditelstvi(?Reditelstvi $idReditelstvi): self
    {
        $this->idReditelstvi = $idReditelstvi;

        return $this;
    }

    /**
     * @return Collection<int, Trida>
     */
    public function getTridy(): Collection
    {
        return $this->tridy;
    }

    public function addTridy(Trida $tridy): self
    {
        if (!$this->tridy->contains($tridy)) {
            $this->tridy[] = $tridy;
            $tridy->setIdZarizeni($this);
        }

        return $this;
    }

    public function removeTridy(Trida $tridy): self
    {
        if ($this->tridy->removeElement($tridy)) {
            // set the owning side to null (unless already changed)
            if ($tridy->getIdZarizeni() === $this) {
                $tridy->setIdZarizeni(null);
            }
        }

        return $this;
    }

    public function getGpsLat(): ?string
    {
        return $this->gpsLat;
    }

    public function setGpsLat(?string $lat): self
    {
        $this->gpsLat = $lat;
        return $this;
    }

    public function getGpsLon(): ?string
    {
        return $this->gpsLon;
    }

    public function setGpsLon(?string $lon): self
    {
        $this->gpsLon = $lon;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getSkolaPlnyNazev().' ('.$this->getIzo().')';
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        $this->sumCapacity();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(): void
    {
        $this->sumCapacity();
    }

    /**
     * @ORM\PostLoad
     */
    public function postLoad(LifecycleEventArgs $eventArgs): void
    {
        // TODO load in listener and calculate just once for all rows?
        $em = $eventArgs->getObjectManager();
        $vlastnosti = $em->getRepository(TridaVlastnosti::class)->findBy(array('aktivni' => true));
        $result = array();
        foreach ($vlastnosti as $vlastnost) {
            if (($vek = $vlastnost->getVekZaka()) !== null) {
                // use only features with age
                $result[$vek][] = $vlastnost->getId();
            }
        }
        $this->tridaVlastnostiId = $result;
    }

    /*
     * calculate sum of capacity for all Trida
     */
    public function sumCapacity(): void
    {
        $tridy = $this->getTridy();
        $free = $full = null;
        foreach ($tridy as $trida) {
            if ($trida->getAktualniKapacitaUkVolno() >= 0) {
                $free += $trida->getAktualniKapacitaUkVolno();
            }
            if ($trida->getAktualniKapacitaUkObsazeno() >= 0) {
                $full += $trida->getAktualniKapacitaUkObsazeno();
            }
        }
        $this->setKapacitaUkVolnoCelkem($free);
        $this->setKapacitaUkObsazenoCelkem($full);
    }

    /*
     * generic method to calculate capacity by age
     */
    protected function getCountByTrida(int $vekZaka): ?int
    {
        if (!isset($this->tridaVlastnostiId[$vekZaka]) || !is_array($this->tridaVlastnostiId[$vekZaka])) {
            return null; // should not happen
        }
        $sum = null;
        foreach($this->getTridy() as $trida) {
            $vlastnosti = $trida->getVlastnosti();
            if (is_array($vlastnosti) && count(array_intersect($vlastnosti, $this->tridaVlastnostiId[$vekZaka])) > 0) {
                // at least one id is matching the list by age
                $sum = $sum + $trida->getAktualniKapacitaUkVolno();
            }
        }
        return $sum;
    }

    public function getTrida2r(): ?int
    {
        return $this->getCountByTrida(2);
    }

    public function getTrida3r(): ?int
    {
        return $this->getCountByTrida(3);
    }

    public function getTrida4r(): ?int
    {
        return $this->getCountByTrida(4);
    }

    public function getTrida5r(): ?int
    {
        return $this->getCountByTrida(5);
    }

    public function getTrida6r(): ?int
    {
        return $this->getCountByTrida(6);
    }

    public function getTrida7r(): ?int
    {
        return $this->getCountByTrida(7);
    }

    public function getTrida8r(): ?int
    {
        return $this->getCountByTrida(8);
    }

    public function getTrida9r(): ?int
    {
        return $this->getCountByTrida(9);
    }

    public function getTrida10r(): ?int
    {
        return $this->getCountByTrida(10);
    }

    public function getTrida11r(): ?int
    {
        return $this->getCountByTrida(11);
    }

    public function getTrida12r(): ?int
    {
        return $this->getCountByTrida(12);
    }

    public function getTrida13r(): ?int
    {
        return $this->getCountByTrida(13);
    }

    public function getTrida14r(): ?int
    {
        return $this->getCountByTrida(14);
    }

    public function getTrida15r(): ?int
    {
        return $this->getCountByTrida(15);
    }

    public function getTrida16r(): ?int
    {
        return $this->getCountByTrida(16);
    }

    public function getTrida17r(): ?int
    {
        return $this->getCountByTrida(17);
    }

    public function getTrida18r(): ?int
    {
        return $this->getCountByTrida(18);
    }

    public function getVolneTridy(): array
    {
        $result = array();
        foreach ($this->getTridy() as $trida) {
            if ($trida->getAktualniKapacitaUkVolno() > 0) {
                $result = array_merge($result, $trida->getVlastnosti());
            }
        }
        sort($result);
        return $result;
    }

    public function getDatumAktualizaceString(): ?string
    {
        // FIXME store in sql?
        if (($tridy = $this->getTridy()) && $tridy->first()) {
            $dt = $tridy->first()->getDatumCasAktualizace();
            return $dt ? $dt->format('j. n. Y') : null;
        } else {
            return null;
        }
    }

    protected function getValueSplit(?string $value, int $index): ?string
    {
        if ($value === null) {
            return null;
        }

        $array = explode(',', $value);
        if (isset($array[$index])) {
            return trim($array[$index]);
        } else {
            return null;
        }
    }
}

