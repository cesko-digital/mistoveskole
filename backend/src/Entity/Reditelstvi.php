<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reditelstvi
 *
 * @ORM\Table(name="reditelstvi", indexes={@ORM\Index(name="reditelstvi_red_adresa_3", columns={"red_adresa_3"}), @ORM\Index(name="reditelstvi_id_orp", columns={"id_orp"}), @ORM\Index(name="reditelstvi_id_okres", columns={"id_okres"}), @ORM\Index(name="reditelstvi_red_plny_nazev", columns={"red_plny_nazev"}), @ORM\Index(name="reditelstvi_red_izo", columns={"red_izo"})})
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
     * @var Orp
     *
     * @ORM\ManyToOne(targetEntity="Orp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_orp", referencedColumnName="id", nullable=false)
     * })
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

    public function getIdOrp(): ?Orp
    {
        return $this->idOrp;
    }

    public function setIdOrp(Orp $idOrp): self
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
        return $this->getRedPlnyNazev().' ('.$this->getRedIzo().')';
    }
}
