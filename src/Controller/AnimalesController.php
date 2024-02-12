<?php

namespace App\Controller;

use App\Entity\Animales;
use App\Form\AnimalesType;
use App\Repository\AnimalesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/animales')]
class AnimalesController extends AbstractController
{
    #[Route('/', name: 'app_animales_index', methods: ['GET'])]
    public function index(AnimalesRepository $animalesRepository): Response
    {
        return $this->render('animales/index.html.twig', [
            'animales' => $animalesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animales_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animale = new Animales();
        $form = $this->createForm(AnimalesType::class, $animale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animale);
            $entityManager->flush();

            return $this->redirectToRoute('app_animales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animales/new.html.twig', [
            'animale' => $animale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animales_show', methods: ['GET'])]
    public function show(Animales $animale): Response
    {
        return $this->render('animales/show.html.twig', [
            'animale' => $animale,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animales_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animales $animale, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalesType::class, $animale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animales/edit.html.twig', [
            'animale' => $animale,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animales_delete', methods: ['POST'])]
    public function delete(Request $request, Animales $animale, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animale->getId(), $request->request->get('_token'))) {
            $entityManager->remove($animale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animales_index', [], Response::HTTP_SEE_OTHER);
    }
}
