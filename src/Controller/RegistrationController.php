<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterForm;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\ProcessingFiles;

class RegistrationController extends AbstractController
{
    /**
     * Display file of the registration form, its processing and registration in Bdd
     *
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer)
    {
        if(!empty($request->get('message'))) {
            $message = $request->get('message');
        }

        $user = new User();

        $form = $this->createForm(RegisterForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($form->get('password')->getData() == $form->get('passwordCheck')->getData()) {

                $extensionFiles = $form->get('picture')->getData()->guessExtension();
                $data = $form->getData();

                $linkAvatar = new ProcessingFiles();
                $linkAvatar = $linkAvatar->processingFiles($data->getPicture(), $extensionFiles, 'imgAvatar');

                $key = md5(microtime(true)*100000);

                $user->setPicture($linkAvatar);
                $user->setPassword($passwordEncoder->encodePassword($user, $data->getPassword()));
                $user->setDateCreate( new \DateTime());
                $user->setConfirmationKey($key);
                $user->setConfirmation('0');
                $em->persist($user);
                $em->flush();

                $emailConfirmation = ( new MailerService())->mailer($mailer, $data->getEmail(), $key);

                $message = 'Félicitation votre compte à été créé vous devez confirmer votre inscription en cliquant
                 sur le lien envoyé sur votre boite mail pour pouvoir vous connecter';

                return $this ->redirectToRoute( 'app_homepage', ['message' => $message] );
            }

        }

        return $this ->render( 'security/register.html.twig', [
            'form' => $form->createView(),
            'message' => $message ?? null
        ] );
    }
}