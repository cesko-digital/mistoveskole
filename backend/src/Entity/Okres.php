<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Okres
 *
 * @ORM\Table(name="okres", indexes={@ORM\Index(name="okres_id_kraj", columns={"id_kraj"})})
 * @ORM\Entity
 */
class Okres
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="okres_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string New nuts since 2004
     *
     * @ORM\Column(name="id_nuts", type="string", length=6, nullable=false)
     */
    private $idNuts;

    /**
     * @var string Legacy nuts ID used by MŠMT
     *
     * @ORM\Column(name="id_nuts2", type="string", length=6, nullable=false)
     */
    private $idNuts2;

    /**
     * @var string
     *
     * @ORM\Column(name="jmeno_cz", type="string", length=100, nullable=false)
     */
    private $jmenoCz;

    /**
     * @var string
     *
     * @ORM\Column(name="jmeno_uk", type="string", length=100, nullable=false)
     */
    private $jmenoUk;

    /**
     * @var \Kraj
     *
     * @ORM\ManyToOne(targetEntity="Kraj")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_kraj", referencedColumnName="id", nullable=false)
     * })
     */
    private $idKraj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdNuts(): ?string
    {
        return $this->idNuts;
    }

    public function setIdNuts(string $idNuts): self
    {
        $this->idNuts = $idNuts;

        return $this;
    }

    public function getJmenoCz(): string
    {
        return $this->jmenoCz;
    }

    public function setJmenoCz(string $jmenoCz): self
    {
        $this->jmenoCz = $jmenoCz;

        return $this;
    }

    public function getJmenoUk(): string
    {
        return $this->jmenoUk;
    }

    public function setJmenoUk(string $jmenoUk): self
    {
        $this->jmenoUk = $jmenoUk;

        return $this;
    }

    public function getIdKraj(): Kraj
    {
        return $this->idKraj;
    }

    public function setIdKraj(?Kraj $idKraj): self
    {
        $this->idKraj = $idKraj;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }

    public function getIdNuts2(): ?string
    {
        return $this->idNuts2;
    }

    public function setIdNuts2(string $idNuts2): self
    {
        $this->idNuts2 = $idNuts2;

        return $this;
    }
}
