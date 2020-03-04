<?php
/**
 * User: michaelgtfr
 * Date: 03/11/2019
 * Time: 10:46
 */

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationAccount
{
    /**
     * Confirmation for registering a user account. This page is reached by a link send by email to the user.
     * @Route("/confirmation", name="app_confirmation")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Session $session
     * @param UrlGeneratorInterface $generator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function confirmationAccount(Request $request, EntityManagerInterface $em,
                                        Session $session, UrlGeneratorInterface $generator)
    {
        $user = new User();
        $user->setEmail($request->get('activation'));
        $user->setConfirmationKey($request->get('cle'));

        if (!empty($user->getEmail()) && !empty($user->getConfirmationKey())) {
            $user = $em->getRepository(User::class)
                ->findOneBy([
                    'email' => $user->getEmail(),
                    'confirmationKey' => $user->getConfirmationKey()
                    ]);

                if(!empty($user)) {
                if($user->getConfirmation() == 1) {
                    $session->getFlashBag()->add(
                        'success',
                        'Votre compte est déjà activer vous pouvez vous connectez ici'
                    );
                    $router = $generator->generate('app_login');
                    return new RedirectResponse($router, 302);
                }
                $user->setConfirmation(1);
                $em->persist($user);
                $em->flush();

                $session->getFlashBag()->add(
                    'success',
                    'Votre compte à été activé vous pouvez dès à présent vous connectez à votre compte '
                );
                $router = $generator->generate('app_login');
                return new RedirectResponse($router, 302);
            }
            $session->getFlashBag()->add(
                'error',
                'Désoler mais votre compte n\'existe pas, 
            veuillez vous inscrire ici si vous voulez collaborer sur ce site.'
            );
            $router = $generator->generate('app_register');
            return new RedirectResponse($router, 302);
        }
        $session->getFlashBag()->add(
            'error',
            'Désoler mais votre compte n\'existe pas, 
        veuillez vous inscrire ici si vous voulez collaborer sur ce site.'
        );
        $router = $generator->generate('app_register');
        return new RedirectResponse($router, 302);
    }
}
