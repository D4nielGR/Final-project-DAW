<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyUserController extends AbstractController
{
    #[Route('/reiews/{userReview}', name: 'app_myReviews')]
    public function myReviews(string $userReview, ReviewRepository $myReviews): Response
    {
        $myReviews = $myReviews->findAll();
        if (!$myReviews) { throw $this->createNotFoundException('Las reviews no existen.'); }

        return $this->render('home/myUser/myreviews.html.twig', [
            "myReviews" => $myReviews,
        ]);
    }
}
