<?php

namespace App\Entity;

use App\Repository\InscriptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionsRepository::class)
 */
class Inscriptions
{

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Sorties::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(name="sorties_no_sortie", referencedColumnName="no_sortie",nullable=false)
     */
    private $sortiesNoSortie;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Participants::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(name="participants_no_participant", referencedColumnName="no_participant",nullable=false)
     */
    private $participantsNoParticipant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getSortiesNoSortie(): ?Sorties
    {
        return $this->sortiesNoSortie;
    }

    public function setSortiesNoSortie(?Sorties $sortiesNoSortie): self
    {
        $this->sortiesNoSortie = $sortiesNoSortie;

        return $this;
    }

    public function participe(?int $sortieId, ?int $participantId, InscriptionsRepository $ir): bool
    {  
        $inscriptions = $ir->findAll();
        foreach ($inscriptions as $inscription) {
            if( $inscription->getParticipantsNoParticipant() == $participantId && $inscription->getSortiesNoSortie() == $sortieId) {
                return true;
            }
            
        }

        return false;
       
    }

    public function getParticipantsNoParticipant(): ?Participants
    {
        return $this->participantsNoParticipant;
    }

    public function setParticipantsNoParticipant(?Participants $participantsNoParticipant): self
    {
        $this->participantsNoParticipant = $participantsNoParticipant;

        return $this;
    }
}
