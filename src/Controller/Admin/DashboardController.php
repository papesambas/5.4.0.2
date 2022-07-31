<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Comments;
use App\Entity\Niveaux;
use App\Entity\Publications;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Walanda 5.4.0.2');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', Users::class);
        yield MenuItem::subMenu('Publications', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Liste des Publications', 'fas fa-list', Publications::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Publications::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des Catégories', 'fas fa-list', Categories::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Categories::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des Niveaux', 'fas fa-list', Niveaux::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Niveaux::class)->setAction(Crud::PAGE_NEW),


        ]);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Comments::class);
    }
}