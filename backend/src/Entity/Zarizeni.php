<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Zarizeni
 *
 * @ORM\Table(name="zarizeni", indexes={@ORM\Index(name="zarizeni_kapacita_ua_volno_celkem", columns={"kapacita_uk_volno_celkem"}), @ORM\Index(name="zarizeni_kapacita_ua_obsazeno_celkem", columns={"kapacita_uk_obsazeno_celkem"}), @ORM\Index(name="zarizeni_skola_plny_nazev", columns={"skola_plny_nazev"}), @ORM\Index(name="zarizeni_id_jazyk", columns={"id_jazyk"}), @ORM\Index(name="zarizeni_misto_adresa_3", columns={"misto_adresa_3"}), @ORM\Index(name="zarizeni_id_skola_typ", columns={"id_skola_typ"}), @ORM\Index(name="zarizeni_izo", columns={"izo"}), @ORM\Index(name="zarizeni_aktivni", columns={"aktivni"}), @ORM\Index(name="IDX_22357A70579B0BCA", columns={"id_reditelstvi"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Zarizeni
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="zarizeni_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="izo", type="integer", nullable=true)
     */
    private $izo;

    /**
     * @var string
     *
     * @ORM\Column(name="skola_plny_nazev", type="string", length=100, nullable=false)
     */
    private $skolaPlnyNazev;

    /**
     * @var int|null
     *
     * @ORM\Column(name="skola_kapacita", type="smallint", nullable=true)
     */
    private $skolaKapacita;

    /**
     * @var bool
     *
     * @ORM\Column(name="aktivni", type="boolean", nullable=false)
     */
    private $aktivni;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_email", type="string", length=100, nullable=true)
     */
    private $kontaktEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_telefon", type="string", length=100, nullable=true)
     */
    private $kontaktTelefon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_jmeno", type="string", length=100, nullable=true)
     */
    private $kontaktJmeno;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_obsazeno_celkem", type="smallint", nullable=true)
     */
    private $kapacitaUkObsazenoCelkem;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kapacita_uk_volno_celkem", type="smallint", nullable=true)
     */
    private $kapacitaUkVolnoCelkem;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kontakt_www", type="string", length=255, nullable=true)
     */
    private $kontaktWww;

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
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_1", type="string", length=100, nullable=true)
     */
    private $mistoAdresa1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_2", type="string", length=100, nullable=true)
     */
    private $mistoAdresa2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="misto_adresa_3", type="string", length=100, nullable=true)
     */
    private $mistoAdresa3;

    /**
     * @var int|null
     *
     * @ORM\Column(name="misto_ruian_kod", type="smallint", nullable=true)
     */
    private $mistoRuianKod;

    /**
     * @var \TypZarizeni
     *
     * @ORM\ManyToOne(targetEntity="TypZarizeni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_skola_typ", referencedColumnName="id", nullable=false)
     * })
     */
    private $idSkolaTyp;

    /**
     * @var \JazykVyuky
     *
     * @ORM\ManyToOne(targetEntity="JazykVyuky")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_jazyk", referencedColumnName="id", nullable=false)
     * })
     */
    private $idJazyk;

    /**
     * @var \Reditelstvi
     *
     * @ORM\ManyToOne(targetEntity="Reditelstvi", inversedBy="zarizeni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reditelstvi", referencedColumnName="id", nullable=false)
     * })
     */
    private $idReditelstvi;

    /**
     * @var \Trida[]
     *
     * @ORM\OneToMany(targetEntity="Trida", mappedBy="idZarizeni", cascade={"persist"}, orphanRemoval=true)
     */
    private $tridy;

    public function __construct()
    {
        $this->tridy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIzo(): ?int
    {
        return $this->izo;
    }

    public function setIzo(?int $izo): self
    {
        $this->izo = $izo;

        return $this;
    }

    public function getSkolaPlnyNazev(): ?string
    {
        return $this->skolaPlnyNazev;
    }

    public function setSkolaPlnyNazev(string $skolaPlnyNazev): self
    {
        $this->skolaPlnyNazev = $skolaPlnyNazev;

        return $this;
    }

    public function getSkolaKapacita(): ?int
    {
        return $this->skolaKapacita;
    }

    public function setSkolaKapacita(?int $skolaKapacita): self
    {
        $this->skolaKapacita = $skolaKapacita;

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

    public function getKontaktEmail(): ?string
    {
        return $this->kontaktEmail;
    }

    public function setKontaktEmail(?string $kontaktEmail): self
    {
        $this->kontaktEmail = $kontaktEmail;

        return $this;
    }

    public function getKontaktTelefon(): ?string
    {
        return $this->kontaktTelefon;
    }

    public function setKontaktTelefon(?string $kontaktTelefon): self
    {
        $this->kontaktTelefon = $kontaktTelefon;

        return $this;
    }

    public function getKontaktJmeno(): ?string
    {
        return $this->kontaktJmeno;
    }

    public function setKontaktJmeno(?string $kontaktJmeno): self
    {
        $this->kontaktJmeno = $kontaktJmeno;

        return $this;
    }

    public function getKapacitaUkObsazenoCelkem(): ?int
    {
        return $this->kapacitaUkObsazenoCelkem;
    }

    public function setKapacitaUkObsazenoCelkem(?int $kapacitaUkObsazenoCelkem): self
    {
        $this->kapacitaUkObsazenoCelkem = $kapacitaUkObsazenoCelkem;

        return $this;
    }

    public function getKapacitaUkVolnoCelkem(): ?int
    {
        return $this->kapacitaUkVolnoCelkem;
    }

    public function setKapacitaUkVolnoCelkem(?int $kapacitaUkVolnoCelkem): self
    {
        $this->kapacitaUkVolnoCelkem = $kapacitaUkVolnoCelkem;

        return $this;
    }

    public function getKontaktWww(): ?string
    {
        return $this->kontaktWww;
    }

    public function setKontaktWww(?string $kontaktWww): self
    {
        $this->kontaktWww = $kontaktWww;

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

    public function getMistoAdresa1(): ?string
    {
        return $this->mistoAdresa1;
    }

    public function setMistoAdresa1(?string $mistoAdresa1): self
    {
        $this->mistoAdresa1 = $mistoAdresa1;

        return $this;
    }

    public function getMistoAdresa2(): ?string
    {
        return $this->mistoAdresa2;
    }

    public function setMistoAdresa2(?string $mistoAdresa2): self
    {
        $this->mistoAdresa2 = $mistoAdresa2;

        return $this;
    }

    public function getMistoAdresa3(): ?string
    {
        return $this->mistoAdresa3;
    }

    public function setMistoAdresa3(?string $mistoAdresa3): self
    {
        $this->mistoAdresa3 = $mistoAdresa3;

        return $this;
    }

    public function getMistoRuianKod(): ?int
    {
        return $this->mistoRuianKod;
    }

    public function setMistoRuianKod(?int $mistoRuianKod): self
    {
        $this->mistoRuianKod = $mistoRuianKod;

        return $this;
    }

    public function getIdSkolaTyp(): ?TypZarizeni
    {
        return $this->idSkolaTyp;
    }

    public function setIdSkolaTyp(?TypZarizeni $idSkolaTyp): self
    {
        $this->idSkolaTyp = $idSkolaTyp;

        return $this;
    }

    public function getIdJazyk(): ?JazykVyuky
    {
        return $this->idJazyk;
    }

    public function setIdJazyk(?JazykVyuky $idJazyk): self
    {
        $this->idJazyk = $idJazyk;

        return $this;
    }

    public function getIdReditelstvi(): ?Reditelstvi
    {
        return $this->idReditelstvi;
    }

    public function setIdReditelstvi(?Reditelstvi $idReditelstvi): self
    {
        $this->idReditelstvi = $idReditelstvi;

        return $this;
    }

    /**
     * @return Collection<int, Trida>
     */
    public function getTridy(): Collection
    {
        return $this->tridy;
    }

    public function addTridy(Trida $tridy): self
    {
        if (!$this->tridy->contains($tridy)) {
            $this->tridy[] = $tridy;
            $tridy->setIdZarizeni($this);
        }

        return $this;
    }

    public function removeTridy(Trida $tridy): self
    {
        if ($this->tridy->removeElement($tridy)) {
            // set the owning side to null (unless already changed)
            if ($tridy->getIdZarizeni() === $this) {
                $tridy->setIdZarizeni(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSkolaPlnyNazev().' ('.$this->getIzo().')';
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist(): void
    {
        $this->sumCapacity();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(): void
    {
        $this->sumCapacity();
    }

    public function sumCapacity(): void
    {
        $tridy = $this->getTridy();
        $free = $full = 0;
        foreach ($tridy as $trida) {
            if ($trida->getAktualniKapacitaUkVolno() > 0) {
                $free += $trida->getAktualniKapacitaUkVolno();
            }
            if ($trida->getAktualniKapacitaUkObsazeno() > 0) {
                $full += $trida->getAktualniKapacitaUkObsazeno();
            }
        }
        $this->setKapacitaUkVolnoCelkem($free);
        $this->setKapacitaUkObsazenoCelkem($full);
    }

}
