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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPassword extends AbstractController
{
    /**
     * Modification of the password of a user after filling in the modification form
     * This page is displayed by a link send to the user email
     * @Route("/resetPassword", name="app_reset_password")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function resetPassword(Request $request, EntityManagerInterface $em,
                                  UserPasswordEncoderInterface $passwordEncoder)
    {
        //Check GET 'user' and 'cle'
        $emailChecked = filter_var($request->get('user'), FILTER_VALIDATE_EMAIL);
        $keyChecked = htmlspecialchars($request->get('cle'));

        //User account recovery
        $user = $em->getRepository(User::class)
            ->findOneBy(['email' => $emailChecked]);

        if (!empty($user) && $user->getConfirmationKey() == $keyChecked) {
            //form creation
            $form = $this->createForm(ResetPasswordForm::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                if ($user->getPassword() === $user->getPasswordCheck()) {
                    $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                    $em->flush();

                    $this ->addFlash( 'success' , 'Vos mot de passe à été modifié');
                    return $this->redirectToRoute("app_homepage");
                }
                $this ->addFlash( 'error' , 'Vos mot de passe ou vos emails sont différents');
            }
            return $this ->render( 'security/forgotPassword.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        $this ->addFlash( 'error' , 'Désolé, votre compte n\'a pas été trouvé,
         vous pouvez ré-essayer le lien envoyer ou reprendre du début le processus de modification du mot de passe');
        return $this->redirectToRoute("app_homepage");
    }
}
