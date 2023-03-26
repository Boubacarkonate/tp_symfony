<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService {
    private $mailer;

    public function __construct(MailerInterface $monmailer)
    {
        $thmailer=$monmailer;
    }


    public function envoieMail($mail_email, $mail_message ) {
        
        $email = (new Email())
        ->from($mail_email)
        ->to($mail_email)
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Symfony mailer')
        ->text($mail_message)
        ->html($mail_message);

            $this->mailer->send($email);
    }


    // public function envoieMail(MailerInterface $mailer, $mail_email, $mail_message ) {
        
    //     $email = (new Email())
    //     ->from($mail_email)
    //     ->to($mail_email)
    //     //->cc('cc@example.com')
    //     //->bcc('bcc@example.com')
    //     //->replyTo('fabien@example.com')                        service avec le MailerInterface $mailer
    //     //->priority(Email::PRIORITY_HIGH)
    //     ->subject('Symfony mailer')
    //     ->text($mail_message)
    //     ->html($mail_message);

    //         $mailer->send($email);
    // }
}


?>