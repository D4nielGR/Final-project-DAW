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
    public function index(NaturalParksRepository $naturalParks, ReviewRepository $reviews): Response
    {
        $parks = $naturalParks->findAll();
        $reviews = $reviews->findAll();
        
        $parkRatings = [];

        foreach ($parks as $park) {
            $parkRatings[$park->getId()] = ['sum' => 0, 'count' => 0];
        }
        
        foreach ($reviews as $review) {
            $parkId = $review->getParkId();
            $valoration = $review->getValoration();
            if (isset($parkRatings[$parkId])) {
                $parkRatings[$parkId]['sum'] += $valoration;
                $parkRatings[$parkId]['count'] += 1;
            }
        }
        
        foreach ($parkRatings as $parkId => $data) {
            if ($data['count'] > 0) {
                $parkRatings[$parkId]['average'] = $data['sum'] / $data['count'];
            } else {
                $parkRatings[$parkId]['average'] = 0;
            }
        }
        
        usort($parks, function($a, $b) use ($parkRatings) {
            $avgA = $parkRatings[$a->getId()]['average'];
            $avgB = $parkRatings[$b->getId()]['average'];
            return $avgB <=> $avgA;
        });
        
        $parksTop = [];
        for ($i = 0; $i < 3; $i++) {
            if (isset($parks[$i])) {
                $park = $parks[$i];
                $parkId = $park->getId();
                $parksTop[] = [
                    'park' => $park,
                    'average' => number_format($parkRatings[$parkId]['average'], 2),
                    'totalReviews' => $parkRatings[$parkId]['count']
                ];
            }
        }

        return $this->render(
            'home/index.html.twig', 
            ["parks" => $parks,
            "parksTop" => $parksTop]
        );
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
    public function park(string $namePark, NaturalParksRepository $naturalParks): Response
    {
        //Muestra el parque según cual de ellos haya sido seleccionado
        $park = $naturalParks->findOneBy(['name' => $namePark]);
        //Si no hay parque informa de ello
        if (!$park) {
            throw $this->createNotFoundException('El parque no existe.');
        }

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
