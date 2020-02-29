<?php
/**
 * User: michaelgtfr
 * Date: 06/12/2019
 * Time: 19:51
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordForm;
use App\Service\ForgotPasswordMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ForgotPassword extends AbstractController
{
    /**
     * Displays the form allowing subsequently, send an email to change your password
     * @Route("/forgotPassword", name="app_forgot_password")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em,
                                   MailerInterface $mailer)
    {
        $user = new User();

        $form = $this->createForm(ForgotPasswordForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $em->getRepository(User::class)
                ->findOneBy(['email' => $data->getEmail()]);

            //send an email
            if (!empty($user)) {
                $sendEmail = (new ForgotPasswordMailer())->forgotPasswordMailer(
                    $mailer,
                    $user,
                    $request->headers->get('host')
                );

                if ($sendEmail == true) {
                    $this->addFlash( 'success' , 'Message envoyé, vous pouvez confirmer le changement 
                de mot de passe en cliquant sur l\'email envoyé');
                    return $this->redirectToRoute("app_homepage");
                }
            }
            $this ->addFlash( 'error' , 'l\'email envoyé est incorrect veuillez vérifier votre email');
        }
        return $this ->render( 'security/forgotPassword.html.twig', [
            'form' => $form->createView(),
            ]);
    }
}
