<?php
/**
 * User: michaelgtfr
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterForm;
use App\Service\CaptchaProtection;
use App\Service\SecurityBreachProtection;
use App\TreatmentForm\RegistrationTreatment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * Display file of the registration form, its processing and registration in Bdd
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailerInterface $mailer
     * @param SecurityBreachProtection $protect
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer,
                             SecurityBreachProtection $protect, EntityManagerInterface $em)
    {
        //form creation
        $user = new User();

        $form = $this->createForm(RegisterForm::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Check the captcha protection
            $captcha = (new CaptchaProtection(
                $request->get('g-recaptcha-response'),
                $request->getClientIp(),
                $request->server->get('CLE_SECURITY_BACK_END')
            ))
            ->serviceCaptcha();

            if ($captcha === true) {
                //Check the password
                $passwordOne = $protect->textProtect($form->get('password')->getData());
                $passwordTwo = $protect->textProtect($form->get('passwordCheck')->getData());

                if(!empty($passwordOne) == !empty($passwordTwo)) {
                    //Check the data
                    $extensionFiles = $protect->textProtect($form->get('picture')->getData()->guessExtension());
                    $data = $form->getData();
                    $user->setEmail($protect->emailProtect($user->getEmail()));
                    $user->setName($protect->textProtect($user->getName()));
                    $user->setPresentation($protect->textProtect($user->getPresentation()));

                    //Data processing
                    $treatment = (new RegistrationTreatment())->treatment(
                        $user,
                        $data,
                        $extensionFiles,
                        $passwordEncoder,
                        $mailer,
                        $em);

                    if ($treatment === true) {
                        $this->addFlash(
                            'success',
                            'Félicitation votre compte a été créé vous devez confirmer votre inscription en cliquant
                        sur le lien envoyé sur votre boite mail pour pouvoir vous connectez'
                        );
                        return $this->redirectToRoute('app_homepage');
                    }
                }
            }
            $this->addFlash(
                'error',
                'Désoler, mais la création du compte n\'a pas abouti, ceci peut être du à un compte existant
                    ou à un problème de mot de passe, veuillez réessayer ultérieurement!!'
            );
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
