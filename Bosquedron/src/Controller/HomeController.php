<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\NaturalParksRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/parks', name: 'app_parks')]
    public function parks(NaturalParksRepository $naturalParks): Response
    {
        //Recoje todos los parques para mostarlos en dicha página
        $parks = $naturalParks->findAll();
        return $this->render('home/parks/parks.html.twig', [
            "parks" => $parks,
        ]);
    }

    #[Route('/parks/{namePark}', name: 'app_park')]
    public function park(string $namePark, NaturalParksRepository $naturalParks, ReviewRepository $reviews, Request $request): Response
    {
        //Muestra el parque según cual de ellos haya sido seleccionado
        $park = $naturalParks->findOneBy(['name' => $namePark]);
        //Si no hay parque informa de ello
        if (!$park) {
            throw $this->createNotFoundException('El parque no existe.');
        }

        //Peticiones para que el usuario pueda ordenar las reviews según la fecha o su valoración
        $sortField = $request->query->get('sort_field', 'reviewDate');
        $sortOrder = $request->query->get('sort_order', 'DESC');

        //Selecciona solo las reviews del parque seleccionado anteriormente
        $reviews = $reviews->findBy(['parkId' => $park->getId()], [$sortField => $sortOrder]);

        //Número total de reviews del parque seleccionado
        $nReviews = count($reviews);

        return $this->render('home/parks/park.html.twig', [
            "park" => $park,
            "reviews" => $reviews,
            'sort_field' => $sortField,
            'sort_order' => $sortOrder,
            'n_reviews' => $nReviews,
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
