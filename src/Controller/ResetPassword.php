<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 07/12/2019
 * Time: 09:33
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\ResetPasswordForm;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPassword extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("/resetPassword", name="app_reset_password")
     */
    public function resetPassword(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $em->getRepository(User::class)
            ->findOneBy(['email' => $request->get('user')]);

        if (!empty($user) && $user->getConfirmationKey() == $request->get('cle')) {

            $form = $this->createForm(ResetPasswordForm::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                if ($request->get('passwordOne') == $request->get('passwordTwo') &&
                $form->get('email')->getData() == $user->getEmail()) {

                    $user->setPassword($passwordEncoder->encodePassword($user, $request->get('passwordOne')));
                    $em->flush();

                    $this ->addFlash( 'success' , 'Vos mot de passe à été modifié');
                    return $this->redirectToRoute("app_homepage");
                }
                $this ->addFlash( 'error' , 'Vos mot de passe ou vos emails sont différents');
            }

            return $this ->render( 'forgotPassword.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        $this ->addFlash( 'error' , 'Desolé, votre compte n\'a pas été trouvé,
         vous pouvez ré-essayer le lien envoyer ou reprendre du début le processus de modification du mot de passe');
        return $this->redirectToRoute("app_homepage");
    }
}