<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/12/2019
 * Time: 19:51
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\ForgotPasswordForm;
use App\Service\ForgotPasswordMailer;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;

class ForgotPassword extends AbstractController
{
    /**
     * @Route("/forgotPassword", name="app_forgot_password")
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em, MailerInterface $mailer )
    {
        $user = new User();

        $form = $this->createForm(ForgotPasswordForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $em->getRepository(User::class)
                ->findOneBy(['email' => $data->getEmail()]);

            if (!empty($user)) {
                (new ForgotPasswordMailer())->forgotPasswordMailer($mailer, $user);
                $this ->addFlash( 'success' , 'Message envoyé, vous pouvez confirmer le changement 
                de mot de passe en cliquant sur l\'email envoyé');
                return $this->redirectToRoute("app_homepage");
            }
            $this ->addFlash( 'success' , 'l\email envoyé est incorrect veuillez vérifié votre email');
        }
        return $this ->render( 'forgotPassword.html.twig', [
            'form' => $form->createView(),
            ]);
    }
}