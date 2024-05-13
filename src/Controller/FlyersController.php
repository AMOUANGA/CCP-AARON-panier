<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Entity\User;
use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;

class FlyersController extends AbstractController
{
    #[Route('/flyers', name: 'flyers')]
    public function index(ProduitRepository $produitRepository,EntityManagerInterface $entityManager): Response
    {
          //afficher le panier
            $user = $this->getUser();
            $panierActifId = $user->getPanierActifId();
            $total = 0;
    // Vérifier si l'utilisateur a déjà un panier actif
    if ($panierActifId !== null) {
    $panierActif = $entityManager->getRepository(Panier::class)->find($panierActifId);
    $total = $panierActif->getTotal();
                                    }



        return $this->render('flyers/index.html.twig', [
            'produits' => $produitRepository->findAll(),
            'controller_name' => 'FlyersController',
            'total' => $total
        ]);
    }
}
