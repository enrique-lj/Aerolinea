<?php
namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Aeropuerto;
use App\Entity\Asiento;
use App\Entity\Avion;
use App\Entity\Reserva;
use App\Entity\Ruta;
use App\Entity\Tarifables;
use App\Entity\User;
use App\Entity\Vuelo;


class DashboardController extends AbstractDashboardController
{
    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
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
         return $this->render('Admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Aerolinea');
    }

    public function configureMenuItems(): iterable
    {
        
        return [
            MenuItem::linkToRoute('Pagina Principal', 'fa fa-home', 'home'),
            MenuItem::subMenu('CRUD', 'fa fa-cogs')->setSubItems([
                MenuItem::linkToCrud('Aeropuerto', 'fa ...', Aeropuerto::class),
                MenuItem::linkToCrud('Asiento', 'fa ...', Asiento::class),
                MenuItem::linkToCrud('Avion', 'fa ...', Avion::class),
                MenuItem::linkToCrud('Reserva', 'fa ...', Reserva::class),
                MenuItem::linkToCrud('Ruta', 'fa ...', Ruta::class),
                MenuItem::linkToCrud('Tarifables', 'fa ...', Tarifables::class),
                MenuItem::linkToCrud('Usuarios', 'fa ...', User::class),
                MenuItem::linkToCrud('Vuelo', 'fa ...', Vuelo::class),
            ]),
        ];
    }


}