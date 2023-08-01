<?php

namespace App\Controller\Admin;

use App\Entity\Experiences;
use App\Entity\Other;
use App\Entity\Projects;
use App\Entity\ResetPasswordRequest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/home.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            -> setTitle('Porfolio')
            -> renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        return[
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
        yield MenuItem::linkToCrud('Projets', 'fa-brands fa-stack-overflow', Projects::class),
        yield MenuItem::linkToCrud('Expériences', 'fa-solid fa-maximize', Experiences::class),
        yield MenuItem::linkToCrud('Autres expériences', 'fa-solid fa-laptop-file', Other::class),
        yield MenuItem::linkToCrud('Requête pour MDP', 'fa-solid fa-key', ResetPasswordRequest::class),
    ];
    }
}
