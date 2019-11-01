<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\ProcessingFiles;

class RegistrationController extends AbstractController
{
    /**
     * Display file of the registration form, its processing and registration in Bdd
     *
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(RegisterForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('password')->getData() == $form->get('passwordCheck')->getData()) {

                $extensionFiles = $form->get('picture')->getData()->guessExtension();
                $data = $form->getData();

                $linkAvatar = new ProcessingFiles();
                $linkAvatar = $linkAvatar->processingFiles($data->getPicture(), $extensionFiles);

                $user->setPicture($linkAvatar);
                $user->setPassword($passwordEncoder->encodePassword($user, $data->getPassword()));
                $user->setDateCreate( new \DateTime());
                $user->setConfirmation('0');
                $em->persist($user);
                $em->flush();

                return $this ->redirectToRoute( 'app_homepage' );
            }

        }

        return $this ->render( 'security/register.html.twig', [
            'form' => $form->createView(),
        ] );
    }
}