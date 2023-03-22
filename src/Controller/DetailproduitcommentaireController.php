<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailproduitcommentaireController extends AbstractController
{
    #[Route('/detailproduitcommentaire/{id}', name: 'app_detailproduitcommentaire')]
    public function index(Request $request, Produit $produit, CommentaireRepository $commentaireRepository): Response
    {


        $commentaire = new Commentaire();

        $form = $this->createForm(ProduitType::class);
        $form->handleRequest($request);

        $commentaireparproduit = $commentaireRepository->findBy(['produit' => $produit]);                //ce 'produit' vient entit(ORM\OneToMany(mappedBy):'produit', target...

        return $this->render('detailproduitcommentaire/index.html.twig', [
            'produit' => $produit,
        ]);


        return $this->renderForm('detailproduitcommentaire/index.html.twig', [
            'produits' => $produit,
            'un_commentaire' => $commentaireparproduit,
            'form' => $form
        ]);
    }
}
