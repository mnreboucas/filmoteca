<?php

namespace App\Controller;

use App\Entity\FilmePremio;
use App\Form\FilmePremioType;
use App\Repository\FilmePremioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filme/premio')]
class FilmePremioController extends AbstractController
{
    #[Route('/', name: 'filme_premio_index', methods: ['GET'])]
    public function index(FilmePremioRepository $filmePremioRepository): Response
    {
        return $this->render('filme_premio/index.html.twig', [
            'filme_premios' => $filmePremioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'filme_premio_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        FilmePremioRepository $filmePremioRepository): Response
    {
        $filmePremio = new FilmePremio();
        $form = $this->createForm(FilmePremioType::class, $filmePremio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filmePremio);
            $entityManager->flush();

            return $this->redirectToRoute('filme_premio_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filme_premio/new_edit.html.twig', [
            'filme_premios' => $filmePremioRepository->findAll(),
            'filme_premio' => $filmePremio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'filme_premio_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        FilmePremio $filmePremio,
        EntityManagerInterface $entityManager,
        FilmePremioRepository $filmePremioRepository): Response
    {
        $form = $this->createForm(FilmePremioType::class, $filmePremio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('filme_premio_edit', [
                'id' => $filmePremio->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filme_premio/new_edit.html.twig', [
            'filme_premios' => $filmePremioRepository->findAll(),
            'filme_premio' => $filmePremio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'filme_premio_delete', methods: ['POST'])]
    public function delete(Request $request, FilmePremio $filmePremio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filmePremio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($filmePremio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filme_premio_index', [], Response::HTTP_SEE_OTHER);
    }
}
