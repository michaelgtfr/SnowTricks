<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerService
{
    /**
     * send email
     */
    public function mailer(MailerInterface $mailer, $adresseUser, $key)
    {
        $email = (new TemplatedEmail())
            ->From('michael.garret.france@gmail.com')
            ->to($adresseUser)
            ->subject('Register email')
            ->htmlTemplate('emails/registrationEmail.html.twig')
            ->context([
                'addressUser' => $adresseUser,
                'key' => $key
            ])
            ;

        $mailer->send($email);
    }
}