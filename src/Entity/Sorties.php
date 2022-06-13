<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sorties
 *
 * @ORM\Table(name="sorties", indexes={@ORM\Index(name="sorties_sites_fk", columns={"sites_no_site"}), @ORM\Index(name="sorties_lieux_fk", columns={"lieux_no_lieu"}), @ORM\Index(name="sorties_participants_fk", columns={"organisateur"}), @ORM\Index(name="sorties_etats_fk", columns={"etats_no_etat"})})
 * @ORM\Entity(repositoryClass="App\Repository\SortiesRepository")
 */
class Sorties
{
    /**
     *
     * @ORM\Column(name="no_sortie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noSortie;

    /**
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     *
     * @ORM\Column(name="datedebut", type="datetime", nullable=false)
     */
    private $datedebut;

    /**
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     *
     * @ORM\Column(name="datecloture", type="datetime", nullable=false)
     */
    private $datecloture;

    /**
     *
     * @ORM\Column(name="nbinscriptionsmax", type="integer", nullable=false)
     */
    private $nbinscriptionsmax;

    /**
     *
     * @ORM\Column(name="descriptioninfos", type="string", length=500, nullable=true)
     */
    private $descriptioninfos;

    /**
     *
     * @ORM\Column(name="etatsortie", type="integer", nullable=true)
     */
    private $etatsortie;

    /**
     *
     * @ORM\Column(name="urlPhoto", type="string", length=250, nullable=true)
     */
    private $urlphoto;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sites_no_site", referencedColumnName="no_site")
     * })
     */
    private $sitesNoSite;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Etats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etats_no_etat", referencedColumnName="no_etat")
     * })
     */
    private $etatsNoEtat;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Participants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organisateur", referencedColumnName="no_participant")
     * })
     */
    private $organisateur;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Lieux")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lieux_no_lieu", referencedColumnName="no_lieu")
     * })
     */
    private $lieuxNoLieu;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Participants", inversedBy="sortiesNoSortie")
     * @ORM\JoinTable(name="inscriptions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="sorties_no_sortie", referencedColumnName="no_sortie")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="participants_no_participant", referencedColumnName="no_participant")
     *   }
     * )
     */
    private $participantsNoParticipant;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participantsNoParticipant = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNoSortie(): ?int
    {
        return $this->noSortie;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDatecloture(): ?\DateTimeInterface
    {
        return $this->datecloture;
    }

    public function setDatecloture(\DateTimeInterface $datecloture): self
    {
        $this->datecloture = $datecloture;

        return $this;
    }

    public function getNbinscriptionsmax(): ?int
    {
        return $this->nbinscriptionsmax;
    }

    public function setNbinscriptionsmax(int $nbinscriptionsmax): self
    {
        $this->nbinscriptionsmax = $nbinscriptionsmax;

        return $this;
    }

    public function getDescriptioninfos(): ?string
    {
        return $this->descriptioninfos;
    }

    public function setDescriptioninfos(?string $descriptioninfos): self
    {
        $this->descriptioninfos = $descriptioninfos;

        return $this;
    }

    public function getEtatsortie(): ?int
    {
        return $this->etatsortie;
    }

    public function setEtatsortie(?int $etatsortie): self
    {
        $this->etatsortie = $etatsortie;

        return $this;
    }

    public function getUrlphoto(): ?string
    {
        return $this->urlphoto;
    }

    public function setUrlphoto(?string $urlphoto): self
    {
        $this->urlphoto = $urlphoto;

        return $this;
    }

    public function getSitesNoSite(): ?Sites
    {
        return $this->sitesNoSite;
    }

    public function setSitesNoSite(?Sites $sitesNoSite): self
    {
        $this->sitesNoSite = $sitesNoSite;

        return $this;
    }

    public function getEtatsNoEtat(): ?Etats
    {
        return $this->etatsNoEtat;
    }

    public function setEtatsNoEtat(?Etats $etatsNoEtat): self
    {
        $this->etatsNoEtat = $etatsNoEtat;

        return $this;
    }

    public function getOrganisateur(): ?Participants
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?Participants $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getLieuxNoLieu(): ?Lieux
    {
        return $this->lieuxNoLieu;
    }

    public function setLieuxNoLieu(?Lieux $lieuxNoLieu): self
    {
        $this->lieuxNoLieu = $lieuxNoLieu;

        return $this;
    }

    /**
     * @return Collection<int, Participants>
     */
    public function getParticipantsNoParticipant(): Collection
    {
        return $this->participantsNoParticipant;
    }

    public function addParticipantsNoParticipant(Participants $participantsNoParticipant): self
    {
        if (!$this->participantsNoParticipant->contains($participantsNoParticipant)) {
            $this->participantsNoParticipant[] = $participantsNoParticipant;
        }

        return $this;
    }

    public function removeParticipantsNoParticipant(Participants $participantsNoParticipant): self
    {
        $this->participantsNoParticipant->removeElement($participantsNoParticipant);

        return $this;
    }

}
