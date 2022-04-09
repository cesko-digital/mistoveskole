<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TridaVlastnosti
 *
 * @ORM\Table(name="trida_vlastnosti", indexes={@ORM\Index(name="trida_vlastnosti_aktivni", columns={"aktivni"})})
 * @ORM\Entity
 */
class TridaVlastnosti
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="trida_vlastnosti_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

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
     * @var bool
     *
     * @ORM\Column(name="aktivni", type="boolean", nullable=false)
     */
    private $aktivni;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAktivni(): ?bool
    {
        return $this->aktivni;
    }

    public function setAktivni(bool $aktivni): self
    {
        $this->aktivni = $aktivni;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }
}
