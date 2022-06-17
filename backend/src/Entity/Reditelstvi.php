<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reditelstvi
 *
 * @ORM\Table(name="reditelstvi", indexes={@ORM\Index(name="reditelstvi_red_zkraceny_zazev", columns={"red_zkraceny_zazev"}), @ORM\Index(name="reditelstvi_id_okres", columns={"id_okres"}), @ORM\Index(name="reditelstvi_red_izo", columns={"red_izo"}), @ORM\Index(name="reditelstvi_datova_schranka", columns={"datova_schranka"}), @ORM\Index(name="reditelstvi_red_adresa_3", columns={"red_adresa_3"}), @ORM\Index(name="reditelstvi_red_plny_nazev", columns={"red_plny_nazev"}), @ORM\Index(name="reditelstvi_id_orp", columns={"id_orp"}), @ORM\Index(name="reditelstvi_id_zrizovatel", columns={"id_zrizovatel"})})
 * @ORM\Entity
 */
class Reditelstvi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="reditelstvi_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="red_izo", type="integer", nullable=true)
     */
    private $redIzo;

    /**
     * @var string
     *
     * @ORM\Column(name="red_plny_nazev", type="string", length=255, nullable=false)
     */
    private $redPlnyNazev;

    /**
     * @var int|null
     *
     * @ORM\Column(name="red_ruian_kod", type="integer", nullable=true)
     */
    private $redRuianKod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="red_adresa_1", type="string", length=100, nullable=true)
     */
    private $redAdresa1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="red_adresa_2", type="string", length=100, nullable=true)
     */
    private $redAdresa2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="red_adresa_3", type="string", length=100, nullable=true)
     */
    private $redAdresa3;

    /**
     * @var int
     *
     * @ORM\Column(name="id_orp", type="smallint", nullable=false)
     */
    private $idOrp;

    /**
     * @var Okres
     *
     * @ORM\ManyToOne(targetEntity="Okres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_okres", referencedColumnName="id", nullable=false)
     * })
     */
    private $idOkres;

    /**
     * @var Zarizeni[]
     *
     * @ORM\OneToMany(targetEntity="Zarizeni", mappedBy="idReditelstvi", cascade={"persist"}, orphanRemoval=true)
     */
    private $zarizeni;

     /**
     * @var string
     *
     * @ORM\Column(name="red_zkraceny_nazev", type="string", length=255, nullable=false)
     */
    private $redZkracenyNazev;

    /**
     * @var string|null
     *
     * @ORM\Column(name="datova_schranka", type="string", length=10, nullable=true)
     */
    private $datovaSchranka;

    /**
     * @var \Zrizovatel
     *
     * @ORM\ManyToOne(targetEntity="Zrizovatel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_zrizovatel", referencedColumnName="id")
     * })
     */
    private $idZrizovatel;

    /**
     * @var string
     *
     * @ORM\Column(name="obec", type="string", length=100, nullable=false)
     */
    private $obec;

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

    public function __construct()
    {
        $this->zarizeni = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRedIzo(): ?int
    {
        return $this->redIzo;
    }

    public function setRedIzo(?int $redIzo): self
    {
        $this->redIzo = $redIzo;

        return $this;
    }

    public function getRedPlnyNazev(): ?string
    {
        return $this->redPlnyNazev;
    }

    public function setRedPlnyNazev(string $redPlnyNazev): self
    {
        $this->redPlnyNazev = $redPlnyNazev;

        return $this;
    }

    public function getRedRuianKod(): ?int
    {
        return $this->redRuianKod;
    }

    public function setRedRuianKod(?int $redRuianKod): self
    {
        $this->redRuianKod = $redRuianKod;

        return $this;
    }

    public function getRedAdresa1(): ?string
    {
        return $this->redAdresa1;
    }

    public function setRedAdresa1(?string $redAdresa1): self
    {
        $this->redAdresa1 = $redAdresa1;

        return $this;
    }

    public function getRedAdresa2(): ?string
    {
        return $this->redAdresa2;
    }

    public function setRedAdresa2(?string $redAdresa2): self
    {
        $this->redAdresa2 = $redAdresa2;

        return $this;
    }

    public function getRedAdresa3(): ?string
    {
        return $this->redAdresa3;
    }

    public function setRedAdresa3(?string $redAdresa3): self
    {
        $this->redAdresa3 = $redAdresa3;

        return $this;
    }

    public function getIdOrp(): ?int
    {
        return $this->idOrp;
    }

    public function setIdOrp(int $idOrp): self
    {
        $this->idOrp = $idOrp;

        return $this;
    }

    public function getIdOkres(): ?Okres
    {
        return $this->idOkres;
    }

    public function setIdOkres(?Okres $idOkres): self
    {
        $this->idOkres = $idOkres;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getRedZkracenyNazev().' ('.$this->getRedIzo().')';
    }

    /**
     * @return Collection<int, Zarizeni>
     */
    public function getZarizeni(): Collection
    {
        return $this->zarizeni;
    }

    public function addZarizeni(Zarizeni $zarizeni): self
    {
        if (!$this->zarizeni->contains($zarizeni)) {
            $this->zarizeni[] = $zarizeni;
            $zarizeni->setIdReditelstvi($this);
        }

        return $this;
    }

    public function removeZarizeni(Zarizeni $zarizeni): self
    {
        if ($this->zarizeni->removeElement($zarizeni)) {
            // set the owning side to null (unless already changed)
            if ($zarizeni->getIdReditelstvi() === $this) {
                $zarizeni->setIdReditelstvi(null);
            }
        }

        return $this;
    }

    public function getRedZkracenyNazev(): ?string
    {
        return $this->redZkracenyNazev;
    }

    public function setRedZkracenyNazev(string $redZkracenyNazev): self
    {
        $this->redZkracenyNazev = $redZkracenyNazev;

        return $this;
    }

    public function getDatovaSchranka(): ?string
    {
        return $this->datovaSchranka;
    }

    public function setDatovaSchranka(?string $datovaSchranka): self
    {
        $this->datovaSchranka = $datovaSchranka;

        return $this;
    }

    public function getIdZrizovatel(): ?Zrizovatel
    {
        return $this->idZrizovatel;
    }

    public function setIdZrizovatel(?Zrizovatel $idZrizovatel): self
    {
        $this->idZrizovatel = $idZrizovatel;

        return $this;
    }

    public function getObec(): ?string
    {
        return $this->obec;
    }

    public function setObec(string $obec): self
    {
        $this->obec = $obec;

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
}
