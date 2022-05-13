<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use App\Repository\GeneroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/genero')]
class GeneroController extends AbstractController
{
    #[Route('/', name: 'genero_index', methods: ['GET'])]
    public function index(GeneroRepository $generoRepository): Response
    {
        return $this->render('genero/index.html.twig', [
            'generos' => $generoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'genero_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        GeneroRepository $generoRepository): Response
    {
        $genero = new Genero();
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genero);
            $entityManager->flush();

            return $this->redirectToRoute('genero_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genero/new_edit.html.twig', [
            'generos' => $generoRepository->findAll(),
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'genero_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Genero $genero,
        EntityManagerInterface $entityManager,
        GeneroRepository $generoRepository): Response
    {
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('genero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genero/new_edit.html.twig', [
            'generos' => $generoRepository->findAll(),
            'genero' => $genero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'genero_delete', methods: ['POST'])]
    public function delete(Request $request, Genero $genero, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genero->getId(), $request->request->get('_token'))) {
            $entityManager->remove($genero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('genero_index', [], Response::HTTP_SEE_OTHER);
    }
}
