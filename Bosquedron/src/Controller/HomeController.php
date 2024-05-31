<?php

namespace App\Controller;

use App\Repository\NaturalParksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/parks', name: 'app_parks')]
    public function parks(NaturalParksRepository $naturalParks): Response
    {
        $parks = $naturalParks->findAll();
        return $this->render('home/parks/parks.html.twig', [
            "parks" => $parks,
        ]);
    }

    #[Route('/parks/{namePark}', name: 'app_park')]
    public function park(string $namePark, NaturalParksRepository $naturalParks): Response
    {
        $park = $naturalParks->findOneBy(['name' => $namePark]);
        return $this->render('home/parks/park.html.twig', [
            "park" => $park,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('home/others/about.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/others/contact.html.twig');
    }
}
