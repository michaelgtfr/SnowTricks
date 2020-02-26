<?php
/**
 * User: michaelgtfr
 * Date: 07/12/2019
 * Time: 09:33
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPasswordForm;
use App\Service\SecurityBreachProtection;
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
     * @param SecurityBreachProtection $protect
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function resetPassword(Request $request, EntityManagerInterface $em,
                                  UserPasswordEncoderInterface $passwordEncoder, SecurityBreachProtection $protect)
    {
        //Check GET 'user' and 'cle'
        $emailChecked = $protect->emailProtect($request->get('user'));
        $keyChecked = $protect->textProtect($request->get('cle'));

        //User account recovery
        $user = $em->getRepository(User::class)
            ->findOneBy(['email' => $emailChecked]);

        if (!empty($user) && $user->getConfirmationKey() == $keyChecked) {

            //form creation
            $form = $this->createForm(ResetPasswordForm::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                //Check data
                $passwordOne = $protect->textProtect($form->get('password')->getData());
                $passwordTwo = $protect->textProtect($form->get('passwordCheck')->getData());
                $emailForm =  $protect->emailProtect($form->get('email')->getData());

                if ($passwordOne === $passwordTwo && $emailForm == $user->getEmail()) {
                    $user->setPassword($passwordEncoder->encodePassword($user, $passwordOne));
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
