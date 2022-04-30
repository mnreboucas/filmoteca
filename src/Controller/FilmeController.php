<?php

namespace App\Controller;

use App\Entity\Filme;
use App\Form\FilmeType;
use App\Repository\FilmeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/filme')]
class FilmeController extends AbstractController
{
    #[Route('/', name: 'filme_index', methods: ['GET'])]
    public function index(FilmeRepository $filmeRepository): Response
    {
        return $this->render('filme/index.html.twig', [
            'filmes' => $filmeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'filme_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        FilmeRepository $filmeRepository): Response
    {
        $filme = new Filme();
        $form = $this->createForm(FilmeType::class, $filme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filme);
            $entityManager->flush();

            return $this->redirectToRoute('filme_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filme/new_edit.html.twig', [
            'filmes' => $filmeRepository->findAll(),
            'filme' => $filme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'filme_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Filme $filme,
        EntityManagerInterface $entityManager,
        FilmeRepository $filmeRepository): Response
    {
        $form = $this->createForm(FilmeType::class, $filme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('filme_edit', [
                'id' => $filme->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filme/new_edit.html.twig', [
            'filmes' => $filmeRepository->findAll(),
            'filme' => $filme,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'filme_delete', methods: ['POST'])]
    public function delete(Request $request, Filme $filme, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filme->getId(), $request->request->get('_token'))) {
            $entityManager->remove($filme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('filme_index', [], Response::HTTP_SEE_OTHER);
    }
}
