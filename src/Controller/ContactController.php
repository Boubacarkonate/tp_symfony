<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailService;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailService $mailService): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data=$form->getData();
            
            $mail_email=$data['votre_email'];
            $mail_message = $data['votre_message'];

            // $mailService->envoieMail($mailer ,$mail_email, $mail_message);          // utilisation du service MailService mais avec la classe MailerInterface et $mailer

            $mailService->envoieMail($mail_email, $mail_message);

        // $email = (new Email())
        // ->from($mail_email)
        // ->to($mail_email)
        // //->cc('cc@example.com')
        // //->bcc('bcc@example.com')                               //envoie email sans service
        // //->replyTo('fabien@example.com')
        // //->priority(Email::PRIORITY_HIGH)
        // ->subject('Symfony mailer')
        // ->text($mail_message)
        // ->html($mail_message);

            // $mailer->send($email);

            
            return $this->render('contact/traitement.html.twig', [
                'donnees_formulaire' => $data
            ]);
            
        }
       
        return $this->renderform('contact/index.html.twig', [
            'formulaire' => $form,
        ]);
    }
}
