<?php
/**
 * User: michaelgtfr
 * Date: 20/12/2019
 * Time: 14:44
 */

namespace App\TreatmentForm;

use App\Entity\User;
use App\Service\MailerService;
use App\Service\ProcessingFiles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationTreatment
{
    /**
     * Processing of data for the creation of a new account
     * @param User $user
     * @param $data
     * @param $extensionFiles
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     * @return bool
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Exception
     */
    public function treatment(User $user,$data, $extensionFiles,
                              UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer,
                              EntityManagerInterface $em)
    {
        /**
         * @var User $data
         */
        //check if the email address has not yet been created
        $accountExist = $em->getRepository(User::class)
            ->findBy(['email' => $data->getEmail()]);


        if (!empty($accountExist)) {
            return false;
        }
        $linkAvatar = new ProcessingFiles();
        $linkAvatar = $linkAvatar->processingFiles($data->getPicture(), $extensionFiles, 'imgAvatar');

        $key = md5(microtime(true)*100000);

        $user->setPicture($linkAvatar);
        $user->setPassword($passwordEncoder->encodePassword($user, $data->getPassword()));
        $user->setDateCreate( new \DateTime());
        $user->setConfirmationKey($key);
        $user->setConfirmation('0');
        $em->persist($user);
        $em->flush();

        $emailConfirmation = ( new MailerService())->mailer($mailer, $data->getEmail(), $key);

        if ($emailConfirmation === true) {
            return true;
        }
    }
}
