<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\User;


class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }


    #[Route('/add_panier/{id}', name: 'add_panier')]
    public function ajouter(EntityManagerInterface $entityManager,Request $request,Produit $produit): Response
    {
        $user = $this->getUser();
        $panierActifId = $user->getPanierActifId();
// Vérifier si l'utilisateur a déjà un panier actif
        if($panierActifId !== null) {
            $panierActif = $entityManager->getRepository(Panier::class)->find($panierActifId);

        }else {
            $panierActif = new Panier();
            $entityManager->persist($panierActif);
            $entityManager->flush();
            $user->setPanierActifId($panierActif->getId());
            $entityManager->flush();
        }
        $panierActif->addProduit($produit);
        $entityManager->flush();
        return $this->redirectToRoute('affiches');
    }
}
