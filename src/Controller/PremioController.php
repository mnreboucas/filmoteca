<?php

namespace App\Controller;

use App\Entity\Premio;
use App\Form\PremioType;
use App\Repository\PremioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/premio')]
class PremioController extends AbstractController
{
    #[Route('/', name: 'premio_index', methods: ['GET'])]
    public function index(PremioRepository $premioRepository): Response
    {
        return $this->render('premio/index.html.twig', [
            'premios' => $premioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'premio_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        PremioRepository $premioRepository): Response
    {
        $premio = new Premio();
        $form = $this->createForm(PremioType::class, $premio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($premio);
            $entityManager->flush();

            return $this->redirectToRoute('premio_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('premio/new_edit.html.twig', [
            'premios' => $premioRepository->findAll(),
            'premio' => $premio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'premio_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Premio $premio,
        EntityManagerInterface $entityManager,
        PremioRepository $premioRepository): Response
    {
        $form = $this->createForm(PremioType::class, $premio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('premio_edit', [
                'id' => $premio->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('premio/new_edit.html.twig', [
            'premios' => $premioRepository->findAll(),
            'premio' => $premio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'premio_delete', methods: ['POST'])]
    public function delete(Request $request, Premio $premio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$premio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($premio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('premio_index', [], Response::HTTP_SEE_OTHER);
    }
}
