<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(Security $security): Response
    {
        $user = $security->getUser();
        if ($user instanceof User) {
            $userData = [
                'userphoto' => $user->getUserphoto(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
            ];
        }
            return $this->json($userData);
    }

    #[Route('/checkLogIn', name: 'app_checkLogIn')]
    public function checkLogIn(AuthorizationCheckerInterface $authorizationChecker): Response
    {
        //Checkea la autorización del usuario
        $isAuthenticated = $authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY');

        //Devuekve true or false
        return new Response($isAuthenticated ? 'true' : 'false');
    }
}
