<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypZarizeni
 *
 * @ORM\Table(name="typ_zarizeni", indexes={@ORM\Index(name="typ_zarizeni_aktivni", columns={"aktivni"}), @ORM\Index(name="typ_zarizeni_tridy_vlastnosti", columns={"tridy_vlastnosti"})})
 * @ORM\Entity
 */
class TypZarizeni
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="typ_zarizeni_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="id_msmt", type="string", length=3, nullable=true)
     */
    private $idMsmt;

    /**
     * @var string
     *
     * @ORM\Column(name="jmeno_cz", type="string", length=50, nullable=false)
     */
    private $jmenoCz;

    /**
     * @var string
     *
     * @ORM\Column(name="jmeno_uk", type="string", length=50, nullable=false)
     */
    private $jmenoUk;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aktivni", type="boolean", nullable=true)
     */
    private $aktivni;

    /**
     * @var array|null
     *
     * @ORM\Column(name="tridy_vlastnosti", type="json", nullable=true)
     */
    private $tridyVlastnosti;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMsmt(): ?string
    {
        return $this->idMsmt;
    }

    public function setIdMsmt(?string $idMsmt): self
    {
        $this->idMsmt = $idMsmt;

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

    public function getAktivni(): ?bool
    {
        return $this->aktivni;
    }

    public function setAktivni(?bool $aktivni): self
    {
        $this->aktivni = $aktivni;

        return $this;
    }

    public function getTridyVlastnosti(): ?array
    {
        return $this->tridyVlastnosti;
    }

    public function setTridyVlastnosti(?array $tridyVlastnosti): self
    {
        $this->tridyVlastnosti = $tridyVlastnosti;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }

}
