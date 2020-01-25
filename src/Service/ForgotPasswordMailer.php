<?php
/**
 * User: michaelgtfr
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
     * Email sent to be able to change your password thanks to the link sent
     * @param MailerInterface $mailer
     * @param User $user
     * @param $host
     * @return bool
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function forgotPasswordMailer(MailerInterface $mailer,User $user, $host)
    {
        $email = (new TemplatedEmail())
            ->From('michael.garret.france@gmail.com')
            ->to($user->getEmail())
            ->subject('forgot password email')
            ->htmlTemplate('emails/forgotPasswordEmail.html.twig')
            ->context([
                'addressUser' => $user->getEmail(),
                'key' => $user->getConfirmationKey(),
                'host' =>$host
            ])
        ;
        $mailer->send($email);

        return true;
    }
}
