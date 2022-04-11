<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Trida
 *
 * @ORM\Table(name="trida", indexes={@ORM\Index(name="trida_aktualni_kapacita_uk_volno", columns={"aktualni_kapacita_uk_volno"}), @ORM\Index(name="idx_trida_vlastnosti", columns={"vlastnosti"}), @ORM\Index(name="trida_aktualni_kapacita_uk_obsazeno", columns={"aktualni_kapacita_uk_obsazeno"}), @ORM\Index(name="trida_datum_cas_aktualizace", columns={"datum_cas_aktualizace"}), @ORM\Index(name="trida_id_zarizeni", columns={"id_zarizeni"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Trida
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="trida_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var array|null
     *
     * @ORM\Column(name="vlastnosti", type="json", nullable=true)
     */
    private $vlastnosti;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poznamka_cz", type="text", nullable=true)
     */
    private $poznamkaCz;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poznamka_uk", type="text", nullable=true)
     */
    private $poznamkaUk;

    /**
     * @var int|null
     *
     * @ORM\Column(name="aktualni_kapacita_uk_obsazeno", type="integer", nullable=true)
     */
    private $aktualniKapacitaUkObsazeno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="aktualni_kapacita_uk_volno", type="integer", nullable=true)
     */
    private $aktualniKapacitaUkVolno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum_cas_aktualizace", type="datetime", nullable=false)
     */
    private $datumCasAktualizace;

    /**
     * @var Zarizeni
     *
     * @ORM\ManyToOne(targetEntity="Zarizeni", inversedBy="tridy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_zarizeni", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    private $idZarizeni;

    /**
     * @var TridaHistorieKapacity[]
     *
     * @ORM\OneToMany(targetEntity="TridaHistorieKapacity", mappedBy="idTrida", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"datum" = "DESC"})
     */
    private $historieKapacity;

    public function __construct()
    {
        $this->historieKapacity = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVlastnosti(): ?array
    {
        return $this->vlastnosti;
    }

    public function setVlastnosti(?array $vlastnosti): self
    {
        $this->vlastnosti = $vlastnosti;

        return $this;
    }

    public function getPoznamkaCz(): ?string
    {
        return $this->poznamkaCz;
    }

    public function setPoznamkaCz(?string $poznamkaCz): self
    {
        $this->poznamkaCz = $poznamkaCz;

        return $this;
    }

    public function getPoznamkaUk(): ?string
    {
        return $this->poznamkaUk;
    }

    public function setPoznamkaUk(?string $poznamkaUk): self
    {
        $this->poznamkaUk = $poznamkaUk;

        return $this;
    }

    public function getAktualniKapacitaUkObsazeno(): ?int
    {
        return $this->aktualniKapacitaUkObsazeno;
    }

    public function setAktualniKapacitaUkObsazeno(?int $aktualniKapacitaUkObsazeno): self
    {
        $this->aktualniKapacitaUkObsazeno = $aktualniKapacitaUkObsazeno;

        return $this;
    }

    public function getAktualniKapacitaUkVolno(): ?int
    {
        return $this->aktualniKapacitaUkVolno;
    }

    public function setAktualniKapacitaUkVolno(?int $aktualniKapacitaUkVolno): self
    {
        $this->aktualniKapacitaUkVolno = $aktualniKapacitaUkVolno;

        return $this;
    }

    public function getDatumCasAktualizace(): ?\DateTimeInterface
    {
        return $this->datumCasAktualizace;
    }

    public function setDatumCasAktualizace(\DateTimeInterface $datumCasAktualizace): self
    {
        $this->datumCasAktualizace = $datumCasAktualizace;

        return $this;
    }

    public function getIdZarizeni(): ?Zarizeni
    {
        return $this->idZarizeni;
    }

    public function setIdZarizeni(?Zarizeni $idZarizeni): self
    {
        $this->idZarizeni = $idZarizeni;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        $this->setDatumCasAktualizace(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        if (!$args->hasChangedField('datumCasAktualizace')) {
            $this->setDatumCasAktualizace(new \DateTime());
        }
    }

    /**
     * @return Collection<int, TridaHistorieKapacity>
     */
    public function getHistorieKapacity(): Collection
    {
        return $this->historieKapacity;
    }

    public function addHistorieKapacity(TridaHistorieKapacity $historieKapacity): self
    {
        if (!$this->historieKapacity->contains($historieKapacity)) {
            $this->historieKapacity[] = $historieKapacity;
            $historieKapacity->setIdTrida($this);
        }

        return $this;
    }

    public function removeHistorieKapacity(TridaHistorieKapacity $historieKapacity): self
    {
        if ($this->historieKapacity->removeElement($historieKapacity)) {
            // set the owning side to null (unless already changed)
            if ($historieKapacity->getIdTrida() === $this) {
                $historieKapacity->setIdTrida(null);
            }
        }

        return $this;
    }
}
