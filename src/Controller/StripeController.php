<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    #[Route('/stripe', name: 'app_stripee')]
    public function index(): Response
    {
            $montant = 100;
            $stripePublicKey = $_ENV['STRIPE_PUBLIC_KEY'];

        return $this->render('stripe/index.html.twig', [
            'stripe_public_key' => $stripePublicKey,
            'montant' => $montant
        ]);
    }
}
