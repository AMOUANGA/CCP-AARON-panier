<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Montant_Total = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Date_commande = null;

    #[ORM\Column(length: 255)]
    private ?string $Statut_commande = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?AdresseLivraison $AdresseLivraison = null;

    #[ORM\OneToMany(mappedBy: 'Commande', targetEntity: DetailCommande::class)]
    private Collection $detailCommandes;

    public function __construct()
    {
        $this->detailCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantTotal(): ?string
    {
        return $this->Montant_Total;
    }

    public function setMontantTotal(string $Montant_Total): static
    {
        $this->Montant_Total = $Montant_Total;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeImmutable
    {
        return $this->Date_commande;
    }

    public function setDateCommande(\DateTimeImmutable $Date_commande): static
    {
        $this->Date_commande = $Date_commande;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->Statut_commande;
    }

    public function setStatutCommande(string $Statut_commande): static
    {
        $this->Statut_commande = $Statut_commande;

        return $this;
    }

    public function getAdresseLivraison(): ?AdresseLivraison
    {
        return $this->AdresseLivraison;
    }

    public function setAdresseLivraison(?AdresseLivraison $AdresseLivraison): static
    {
        $this->AdresseLivraison = $AdresseLivraison;

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
            $detailCommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): static
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getCommande() === $this) {
                $detailCommande->setCommande(null);
            }
        }

        return $this;
    }
}
