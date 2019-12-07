<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/12/2019
 * Time: 20:30
 */

namespace App\Service;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ForgotPasswordMailer
{
    /**
     * email sent to be able to change your password thanks to the link sent
     *
     * @param MailerInterface $mailer
     * @param $adresseUser
     * @param $key
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function forgotPasswordMailer(MailerInterface $mailer,User $user)
    {
        $email = (new TemplatedEmail())
            ->From('michael.garret.france@gmail.com')
            ->to($user->getEmail())
            ->subject('forgot password email')
            ->htmlTemplate('emails/forgotPasswordEmail.html.twig')
            ->context([
                'addressUser' => $user->getEmail(),
                'key' => $user->getConfirmationKey(),
            ])
        ;

        $mailer->send($email);
    }
}