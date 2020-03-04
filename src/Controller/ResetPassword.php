<?php
/**
 * User: michaelgtfr
 * Date: 07/12/2019
 * Time: 09:33
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class ResetPassword
{
    /**
     * Modification of the password of a user after filling in the modification form
     * This page is displayed by a link send to the user email
     * @Route("/resetPassword", name="app_reset_password")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FormFactoryInterface $formFactory
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @param Environment $twig
     * @return RedirectResponse|Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function resetPassword(Request $request, EntityManagerInterface $em, FormFactoryInterface $formFactory,
                                  UserPasswordEncoderInterface $passwordEncoder, Session $session,
                                  UrlGeneratorInterface $generator, Environment $twig)
    {
        //Check GET 'user' and 'cle'
        $emailChecked = filter_var($request->get('user'), FILTER_VALIDATE_EMAIL);
        $keyChecked = htmlspecialchars($request->get('cle'));

        //User account recovery
        $user = $em->getRepository(User::class)
            ->findOneBy(['email' => $emailChecked]);

        if (!empty($user) && $user->getConfirmationKey() == $keyChecked) {
            //form creation
            $form = $formFactory->create(ResetPasswordForm::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                if ($user->getPassword() === $user->getPasswordCheck()) {
                    $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                    $em->flush();

                    $session->getFlashBag()->add( 'success' , 'Vos mot de passe à été modifié');
                    $router = $generator->generate('app_homepage');
                    return new RedirectResponse($router, 302);
                }
                $session->getFlashBag()->add('error' , 'Vos mot de passe ou vos emails sont différents');
            }
            $render = $twig->render( 'security/forgotPassword.html.twig', [
                'form' => $form->createView(),
            ]);
            return new Response($render);
        }
        $session->getFlashBag()->add( 'error' , 'Désolé, votre compte n\'a pas été trouvé,
         vous pouvez ré-essayer le lien envoyer ou reprendre du début le processus de modification du mot de passe');
        $router = $generator->generate('app_homepage');
        return new RedirectResponse($router, 302);
    }
}
