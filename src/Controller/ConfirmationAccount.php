<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/11/2019
 * Time: 10:46
 */

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ConfirmationAccount extends AbstractController
{
    /**
     * Confirmation for registering a user account
     *
     * @Route("/confirmation", name="app_confirmation")
     * @param Request $request
     */
    public function confirmationAccount(Request $request, EntityManagerInterface $em)
    {
        if (!empty($request->get('activation')) && !empty($request->get('cle'))) {
            $email = filter_var($request->get('activation'),FILTER_VALIDATE_EMAIL);

            $user = $em->getRepository(User::class)
                ->findOneBy([
                    'email' => $email,
                    'confirmationKey' => $request->get('cle')
                    ]);

                if( !empty($user)) {
                if($user->getConfirmation() == 1) {

                    $message = 'Votre compte est déjà activer vous pouvez vous connectez ici';

                    return $this->redirectToRoute('app_login', ['message' => $message]);
                }

                $user->setConfirmation(1);
                $em->persist($user);
                $em->flush();

                $message = 'Votre compte à été activé vous pouvez dès à présent vous connectez à votre compte ';

                return $this->redirectToRoute('app_login', ['message' => $message]);
            }

            $message = 'Désoler mais votre compte n\'existe pas, 
            veuillez vous inscrire ici si vous voulez collaboré sur ce site.';

            return $this->redirectToRoute('app_register', ['message' => $message]);
        }

        $message = 'Désoler mais votre compte n\'existe pas, 
        veuillez vous inscrire ici si vous voulez collaboré sur ce site.';

        return $this->redirectToRoute('app_register', ['message' => $message]);
    }
}