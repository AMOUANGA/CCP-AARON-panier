<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcceuilController extends AbstractController
{
    #[Route('', name: 'acceuil')]
    public function index(): Response
    {
        //dd($this->getUser()); // équivalent de app.user en twig

        return $this->render('acceuil/index.html.twig', []);
    }

/**
 * @Route("/catalogue",name="catalogue")
 */
    public function catalogue(ProduitRepository $produitRepository) : Response
{
        $produits = $produitRepository->findAll();
        return $this->render('accueil/catalogue.html.twig', [
            'produits' => $produits
        ]);
}



/**
 * @Route("/fiche{id}",name="fiche_produit")
 */

public function ficheProduit(Produit $produit) : Response
{
        
        return $this->render('acceuil/ficheProduit.html.twig', [
            'produit' => $produit
        ]);
}



}
