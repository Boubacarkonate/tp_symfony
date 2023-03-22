<?php

namespace App\Controller;

use App\Form\JeuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JeuController extends AbstractController
{
    
    #[Route('/jeu', name: 'app_jeu')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(JeuType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $donnees = $form->getData();
            
            $donnees['chiffre gagnant'] = 55;
            
            if ($donnees['chiffre gagnant'] == $donnees['choix']) {

                return $this->render('jeu/traitementgagne.html.twig',[
                'donnees_formulaire' => $donnees  
             ]);

    } else {
        
        return $this->render('jeu/traitementperdu.html.twig',[
            'donnees_formulaire' => $donnees 
         ]); 
    }
                  

    }

            return $this->renderForm('jeu/index.html.twig', [
            'jeu' => $form
           ]); 
        
    }
}
       