<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sites
 *
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 */
class Sites
{
    /**
     *
     * @ORM\Column(name="no_site", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $noSite;

    /**
     *
     * @ORM\Column(name="nom_site", type="string", length=30, nullable=false)
     */
    private $nomSite;

    public function getNoSite(): ?int
    {
        return $this->noSite;
    }

    public function getNomSite(): ?string
    {
        return $this->nomSite;
    }

    public function setNomSite(string $nomSite): self
    {
        $this->nomSite = $nomSite;

        return $this;
    }


}
