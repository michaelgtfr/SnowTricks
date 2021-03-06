<?php
/**
 * User: michaelgtfr
 */

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerService
{
    /**
     * Send email for the registration
     * @param MailerInterface $mailer
     * @param $addressUser
     * @param $key
     * @param $host
     * @return bool
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function mailer(MailerInterface $mailer, $addressUser, $key, $host)
    {
        $email = (new TemplatedEmail())
            ->From('michael.garret.france@gmail.com')
            ->to($addressUser)
            ->subject('Register email')
            ->htmlTemplate('emails/registrationEmail.html.twig')
            ->context([
                'addressUser' => $addressUser,
                'key' => $key,
                'host' => $host
            ])
            ;
        $mailer->send($email);

        return true;
    }
}
