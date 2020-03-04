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
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ForgotPassword
{
    /**
     * Displays the form allowing subsequently, send an email to change your password
     * @Route("/forgotPassword", name="app_forgot_password")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param MailerInterface $mailer
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param UrlGeneratorInterface $generator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function forgotPassword(Request $request, EntityManagerInterface $em, Session $session,
                                   MailerInterface $mailer, FormFactoryInterface $formFactory, Environment $twig,
                                   UrlGeneratorInterface $generator)
    {
        $user = new User();
        $form = $formFactory->create(ForgotPasswordForm::class, $user);

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
                    $session->getFlashBag()->add('success' ,
                        'Message envoyé, vous pouvez confirmer le changement 
                de mot de passe en cliquant sur l\'email envoyé');
                    $router = $generator->generate('app_homepage');
                    return new RedirectResponse($router, 302);
                }
            }
            $session->getFlashBag()->add('error' ,
                'l\'email envoyé est incorrect veuillez vérifier votre email');
        }
        $render = $twig->render( 'security/forgotPassword.html.twig', [
            'form' => $form->createView(),
            ]);
        return new Response($render);
    }
}
