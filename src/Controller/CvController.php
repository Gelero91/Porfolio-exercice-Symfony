<?php

namespace App\Controller;

use App\Repository\ExperiencesRepository;
use App\Repository\TrainingRepository;
use App\Repository\OtherRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    #[Route('/cv', name: 'app_cv')]
    public function index(ExperiencesRepository $experiencesRepository,TrainingRepository $trainingRepository, OtherRepository $otherRepository): Response
    {
        return $this->render('cv/index.html.twig', [
            'controller_name' => 'CvController',
            'experiences' => $experiencesRepository->findAll(),
            'trainings' => $trainingRepository->findAll(),
            'others' => $otherRepository->findAll(),
        ]);
    }
}
