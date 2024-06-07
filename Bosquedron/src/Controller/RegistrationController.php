<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\Authenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Handle the user photo upload
            $userPhotoFile = $form->get('userPhoto')->getData();

            if ($userPhotoFile) {
                $originalFilename = pathinfo($userPhotoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$userPhotoFile->guessExtension();

                try {
                    $userPhotoFile->move(
                        $this->getParameter('user_photos_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Handle the exception if something happens during file upload
                }

                $user->setUserPhoto($newFilename);
            } else {
                // Set the default user photo if none is uploaded
                $user->setUserPhoto('userPhotoPre.jpg');
            }

            $entityManager->persist($user);
            $entityManager->flush();

            // Login the user
            return $security->login($user, Authenticator::class, 'main');
        }

        return $this->render('home/Reg&Log/registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
