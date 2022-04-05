<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kraj
 *
 * @ORM\Table(name="kraj")
 * @ORM\Entity
 */
class Kraj
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="kraj_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_nuts", type="string", length=6, nullable=false)
     */
    private $idNuts;

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

    public function getJmenoCz(): ?string
    {
        return $this->jmenoCz;
    }

    public function setJmenoCz(string $jmenoCz): self
    {
        $this->jmenoCz = $jmenoCz;

        return $this;
    }

    public function getJmenoUk(): ?string
    {
        return $this->jmenoUk;
    }

    public function setJmenoUk(string $jmenoUk): self
    {
        $this->jmenoUk = $jmenoUk;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }
}
