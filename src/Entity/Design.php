<?php

namespace App\Entity;

use App\Repository\DesignRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DesignRepository::class)]
class Design
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Couleur = null;

    #[ORM\Column(length: 255)]
    private ?string $Police = null;

    #[ORM\Column(length: 255)]
    private ?string $Taille_Police = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Contenu $Contenu = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): static
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getPolice(): ?string
    {
        return $this->Police;
    }

    public function setPolice(string $Police): static
    {
        $this->Police = $Police;

        return $this;
    }

    public function getTaillePolice(): ?string
    {
        return $this->Taille_Police;
    }

    public function setTaillePolice(string $Taille_Police): static
    {
        $this->Taille_Police = $Taille_Police;

        return $this;
    }

    public function getContenu(): ?Contenu
    {
        return $this->Contenu;
    }

    public function setContenu(?Contenu $Contenu): static
    {
        $this->Contenu = $Contenu;

        return $this;
    }


}
