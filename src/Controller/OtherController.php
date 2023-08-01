<?php

namespace App\Controller;

use App\Entity\Other;
use App\Form\OtherType;
use App\Repository\OtherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/other')]
class OtherController extends AbstractController
{
    #[Route('/', name: 'app_other_index', methods: ['GET'])]
    public function index(OtherRepository $otherRepository): Response
    {
        return $this->render('other/index.html.twig', [
            'others' => $otherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_other_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $other = new Other();
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($other);
            $entityManager->flush();

            return $this->redirectToRoute('app_other_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('other/new.html.twig', [
            'other' => $other,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_other_show', methods: ['GET'])]
    public function show(Other $other): Response
    {
        return $this->render('other/show.html.twig', [
            'other' => $other,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_other_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Other $other, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_other_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('other/edit.html.twig', [
            'other' => $other,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_other_delete', methods: ['POST'])]
    public function delete(Request $request, Other $other, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$other->getId(), $request->request->get('_token'))) {
            $entityManager->remove($other);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_other_index', [], Response::HTTP_SEE_OTHER);
    }
}
