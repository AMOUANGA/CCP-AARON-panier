<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Prestation $Prestation = null;

    #[ORM\ManyToOne(inversedBy: 'Produit')]
    private ?Taille $taille = null;

    #[ORM\ManyToOne(inversedBy: 'Produit')]
    private ?OptionNom $optionNom = null;


    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: DetailCommande::class)]
    private Collection $detailCommandes;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Contenu::class)]
    private Collection $Contenu;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    #[ORM\ManyToMany(targetEntity: Panier::class, mappedBy: 'Produit')]
    private Collection $paniers;

    public function __construct()
    {
        $this->detailCommandes = new ArrayCollection();
        $this->Contenu = new ArrayCollection();
        $this->paniers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->Prestation;
    }

    public function setPrestation(?Prestation $Prestation): static
    {
        $this->Prestation = $Prestation;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getOptionNom(): ?OptionNom
    {
        return $this->optionNom;
    }

    public function setOptionNom(?OptionNom $optionNom): static
    {
        $this->optionNom = $optionNom;

        return $this;
    }





    /**
     * @return Collection<int, DetailCommande>
     */
    public function getDetailCommandes(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetailCommande(DetailCommande $detailCommande): static
    {
        if (!$this->detailCommandes->contains($detailCommande)) {
            $this->detailCommandes->add($detailCommande);
            $detailCommande->setProduit($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): static
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getProduit() === $this) {
                $detailCommande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contenu>
     */
    public function getContenu(): Collection
    {
        return $this->Contenu;
    }

    public function addContenu(Contenu $contenu): static
    {
        if (!$this->Contenu->contains($contenu)) {
            $this->Contenu->add($contenu);
            $contenu->setProduit($this);
        }

        return $this;
    }

    public function removeContenu(Contenu $contenu): static
    {
        if ($this->Contenu->removeElement($contenu)) {
            // set the owning side to null (unless already changed)
            if ($contenu->getProduit() === $this) {
                $contenu->setProduit(null);
            }
        }

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
//additionner les prix de la prestation, de la taille et de l'option
    public function getPrix() 
    {
        $prixPrestation = $this->getPrestation() !== null ? $this->getPrestation()->getPrix() : 0;
        $prixTaille= $this->getTaille() !== null ? $this->getTaille()->getPrix() : 0;
        $prixOptionNom= $this->getOptionNom() !== null ? $this->getOptionNom()->getPrix() : 0;
                
                return floatval($prixPrestation) + floatval($prixTaille)  + floatval($prixOptionNom );
    }

//fonction afin de recuperer le nom de la prestation
public function getNom(){
    return $this->getPrestation()->getNom();
}
    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->addProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            $panier->removeProduit($this);
        }

        return $this;
    }
}
