<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TridaHistorieKapacity
 *
 * @ORM\Table(name="trida_historie_kapacity", indexes={@ORM\Index(name="trida_historie_kapacity_id_trida", columns={"id_trida"}), @ORM\Index(name="trida_historie_kapacity_datum", columns={"datum"})})
 * @ORM\Entity
 */
class TridaHistorieKapacity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="trida_historie_kapacity_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date", nullable=false)
     */
    private $datum;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_obsazeno", type="smallint", nullable=true)
     */
    private $kapacitaUkObsazeno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_volno", type="smallint", nullable=true)
     */
    private $kapacitaUkVolno;

    /**
     * @var Trida
     *
     * @ORM\ManyToOne(targetEntity="Trida", inversedBy="historieKapacity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_trida", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    private $idTrida;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getKapacitaUkObsazeno(): ?int
    {
        return $this->kapacitaUkObsazeno;
    }

    public function setKapacitaUkObsazeno(?int $kapacitaUkObsazeno): self
    {
        $this->kapacitaUkObsazeno = $kapacitaUkObsazeno;

        return $this;
    }

    public function getKapacitaUkVolno(): ?int
    {
        return $this->kapacitaUkVolno;
    }

    public function setKapacitaUkVolno(?int $kapacitaUkVolno): self
    {
        $this->kapacitaUkVolno = $kapacitaUkVolno;

        return $this;
    }

    public function getIdTrida(): ?Trida
    {
        return $this->idTrida;
    }

    public function setIdTrida(?Trida $idTrida): self
    {
        $this->idTrida = $idTrida;

        return $this;
    }


}
