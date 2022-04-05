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
     * @ORM\Column(name="jmeno", type="string", length=100, nullable=false)
     */
    private $jmeno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getJmeno();
    }
}
