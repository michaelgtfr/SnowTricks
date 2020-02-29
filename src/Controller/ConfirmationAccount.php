<?php
/**
 * User: michaelgtfr
 * Date: 03/11/2019
 * Time: 10:46
 */

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationAccount extends AbstractController
{
    /**
     * Confirmation for registering a user account. This page is reached by a link send by email to the user.
     *
     * @Route("/confirmation", name="app_confirmation")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function confirmationAccount(Request $request, EntityManagerInterface $em)
    {
        $user = new User();
        $user->setEmail($request->get('activation'));
        $user->setConfirmationKey($request->get('cle'));

        if (!empty($emailCheck) && !empty($keyCheck)) {
            $user = $em->getRepository(User::class)
                ->findOneBy([
                    'email' => $user->getEmail(),
                    'confirmationKey' => $user->getConfirmationKey()
                    ]);

                if( !empty($user)) {
                if($user->getConfirmation() == 1) {
                    $this->addFlash(
                        'success',
                        'Votre compte est déjà activer vous pouvez vous connectez ici'
                    );
                    return $this->redirectToRoute('app_login');
                }
                $user->setConfirmation(1);
                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Votre compte à été activé vous pouvez dès à présent vous connectez à votre compte '
                );
                return $this->redirectToRoute('app_login');
            }
            $this->addFlash(
                'error',
                'Désoler mais votre compte n\'existe pas, 
            veuillez vous inscrire ici si vous voulez collaborer sur ce site.'
            );
            return $this->redirectToRoute('app_register');
        }
        $this->addFlash(
            'error',
            'Désoler mais votre compte n\'existe pas, 
        veuillez vous inscrire ici si vous voulez collaborer sur ce site.'
        );
        return $this->redirectToRoute('app_register');
    }
}
