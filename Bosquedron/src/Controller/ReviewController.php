<?php

namespace App\Controller;

use App\Repository\NaturalParksRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReviewController extends AbstractController
{
    #[Route('/review/{parkId}', name: 'app_review')]
    public function reviews(string $parkId, Request $request, UserRepository $users, ReviewRepository $reviews): Response
    {
        $reviewsPark = $reviews->findBy(['parkId' => $parkId]);
        if (!$reviewsPark) { throw $this->createNotFoundException('La review no existe.'); }
        $totalReviewsPark = count($reviewsPark);

        /*$sortBy = $request->query->get('sortBy', 'date');
        $sortOrder = $request->query->get('sortOrder', 'asc');

        $reviews = $reviews->findBy(
            [$sortBy => $sortOrder]
        );*/
        
        $reviewsData = [];
        foreach ($reviewsPark as $review) {
            // Obtener el usuario asociado a la revisión
            $user = $users->find($review->getUserId());
            // Verificar si se encontró el usuario
            if ($user) {
                // Obtener el nombre de usuario
                $username = $user->getUsername();
                $userphoto = $user->getUserphoto();
            } else {
                // Si no se encuentra el usuario, establecer un valor predeterminado
                $username = 'Usuario desconocido';
                $userphoto = 'Foto desconocida';
            }
    
            $reviewsData[] = [
                'id' => $review->getId(),
                'userId' => $review->getUserId(),
                'valoration' => $review->getValoration(),
                'reviewText' => $review->getReviewText(),
                'reviewDate' => $review->getReviewDate(),
                'username' => $username,
                'userphoto' => $userphoto,
            ];
        }

        return new JsonResponse(['reviews' => $reviewsData,'totalReviews' => $totalReviewsPark]);
    }
}