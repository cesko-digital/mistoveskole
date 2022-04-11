<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JazykVyuky
 *
 * @ORM\Table(name="jazyk_vyuky")
 * @ORM\Entity
 */
class JazykVyuky
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="jazyk_vyuky_id_seq", allocationSize=1, initialValue=1)
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmenoCz(): ?string
    {
        return $this->jmenoCz;
    }

    public function setJmenoCz(string $jmeno): self
    {
        $this->jmenoCz = $jmeno;

        return $this;
    }

    public function getJmenoUk(): ?string
    {
        return $this->jmenoUk;
    }

    public function setJmenoUk(string $jmeno): self
    {
        $this->jmenoUk = $jmeno;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }
}
