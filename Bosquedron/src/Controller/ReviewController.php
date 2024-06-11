<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ReviewController extends AbstractController
{
    #[Route('/review/{parkId}', name: 'app_review')]
    public function reviews(string $parkId, Request $request, UserRepository $users, ReviewRepository $reviews): Response
    {
        //Busca las reviews del parque actual
        $reviewsPark = $reviews->findBy(['parkId' => $parkId]);
        if (!$reviewsPark) { throw $this->createNotFoundException('La review no existe.'); }

        // Calcular el total de las valoraciones
        $totalReviewsPark = count($reviewsPark);

        // Calcular el promedio de las valoraciones
        $totalReviews = 0;
        foreach ($reviewsPark as $review) { $totalReviews += $review->getValoration(); }
        $averageReviews = $totalReviewsPark > 0 ? $totalReviews / $totalReviewsPark : 0;

        /*$sortBy = $request->query->get('sortBy', 'date');
        $sortOrder = $request->query->get('sortOrder', 'asc');

        $reviews = $reviews->findBy(
            [$sortBy => $sortOrder]
        );*/
        
        $reviewsData = [];
        foreach ($reviewsPark as $review) {
            $user = $users->find($review->getUserId());
            if ($user) {
                $username = $user->getUsername();
                $userphoto = "/storageDB/images/users/" . $user->getUserphoto();
            } else {
                $username = 'Usuario desconocido';
                $userphoto = 'Foto desconocida';
            }
    
            $reviewsData[] = [
                'id' => $review->getId(),
                'valoration' => $review->getValoration(),
                'reviewText' => $review->getReviewText(),
                'reviewDate' => $review->getReviewDate()->format('Y-m-d H:i:s'),
                'username' => $username,
                'userphoto' => $userphoto,
            ];
        }

        return new JsonResponse([
            'reviews' => $reviewsData,
            'totalReviews' => $totalReviewsPark, 
            'averageReviews' => $averageReviews
        ]);
    }

    #[Route('/api/review/newReview', name: 'app_newReview', methods: ['POST'])]
    public function submitReview(Request $request, EntityManagerInterface $entityManager): Response
    {
            $data = json_decode($request->getContent(), true);

            if ($data === null) {
                throw new \Exception('Invalid JSON');
            }

            $review = new Review();
            $review->setValoration((int) $data['rating']);
            $review->setReviewText($data['textReview']);
            $review->setParkId((int) $data['parkId']);
            $review->setUserId((int) $data['userId']);

            $currentDate = new \DateTime();
            $formattedDate = $currentDate->format('Y-m-d H:i:s');
            $review->setReviewDate(\DateTime::createFromFormat('Y-m-d H:i:s', $formattedDate));
            

            $entityManager->persist($review);
            $entityManager->flush();

            return new JsonResponse(['status' => 'ok', 'received_data' => $data]);
    }
}