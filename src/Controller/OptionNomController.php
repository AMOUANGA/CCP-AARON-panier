<?php

namespace App\Controller;

use App\Entity\OptionNom;
use App\Form\OptionNomType;
use App\Repository\OptionNomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/option/nom')]
class OptionNomController extends AbstractController
{
    #[Route('/', name: 'app_option_nom_index', methods: ['GET'])]
    
    public function index(OptionNomRepository $optionNomRepository): Response
    {
        return $this->render('option_nom/index.html.twig', [
            'option_noms' => $optionNomRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_option_nom_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $optionNom = new OptionNom();
        $form = $this->createForm(OptionNomType::class, $optionNom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($optionNom);
            $entityManager->flush();

            return $this->redirectToRoute('app_option_nom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('option_nom/new.html.twig', [
            'option_nom' => $optionNom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_option_nom_show', methods: ['GET'])]
    public function show(OptionNom $optionNom): Response
    {
        return $this->render('option_nom/show.html.twig', [
            'option_nom' => $optionNom,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_option_nom_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OptionNom $optionNom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OptionNomType::class, $optionNom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_option_nom_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('option_nom/edit.html.twig', [
            'option_nom' => $optionNom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_option_nom_delete', methods: ['POST'])]
    public function delete(Request $request, OptionNom $optionNom, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$optionNom->getId(), $request->request->get('_token'))) {
            $entityManager->remove($optionNom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_option_nom_index', [], Response::HTTP_SEE_OTHER);
    }
}
