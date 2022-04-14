<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zrizovatel
 *
 * @ORM\Table(name="zrizovatel")
 * @ORM\Entity
 */
class Zrizovatel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="zrizovatel_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="jmeno_cz", type="string", length=50, nullable=false)
     */
    private $jmenoCz;

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString(): string
    {
        return $this->getJmenoCz();
    }
}
