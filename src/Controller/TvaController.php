<?php

namespace App\Controller;

use App\Form\TvaType;
use App\Service\TvaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TvaController extends AbstractController
{
    #[Route('/tva', name: 'app_tva')]
    public function index(Request $request, TvaService $tvaService): Response           //les paramètres que je veux utiliser. Toujours mettre les variables avec sa class que j'importe en haut
    {


        $form = $this->createForm(TvaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();
           // $data['tva']=$data['prix']*0.2;    code pour calculer tva sans le Service
            
           $data['tva'] = $tvaService->calcul($data['prix']);       //utilisation du service qui appelle de la methode calcul


            return $this->render('tva/traitement.html.twig',[
                'resultat'=>$data
            ]);
        }

            return $this->renderForm('tva/index.html.twig', [
                'formulaire_tva' => $form,
        ]);
    }
}
