<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */

class ProfilController extends AbstractController
{
    #[Route('', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', []);
    }


    #[Route('/modifier', name: 'app_profil_edit')]
    public function edit(): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);

        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
