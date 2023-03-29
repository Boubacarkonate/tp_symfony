<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


 #[Route('/cart')]
class CartController extends AbstractController
{
   
    

    // #[Route('/add/{id}', name: 'app_cart_add')]
    // public function index(Produit $produit, RequestStack $session): Response
    // {

    //    dd($session->getSession()->set("panier",[]));

    //     return $this->render('cart/index.html.twig', [
    //         'controller_name' => 'CartController',
    //     ]);
    // }

    // #[Route('/show', name: 'app_cart_show')]
    // public function show(RequestStack $session): Response
    // {
    //     dd($session->getSession()->get("panier",[]));

    //     return $this->render('cart/index.html.twig', [
    //         'controller_name' => 'CartController',
    //     ]);
    // }

    #[Route('/add/{id}', name: 'app_cart_add')]
    public function index(RequestStack $session, $id): Response         //j'ai enlevé le Produit $produit car je n'ai pas besoin du param convert
    {

      $panier = $session->getSession()->get("panier",[]);

      if (empty($panier[$id])) {
        $panier[$id]=0;
      }

       $panier[$id]++ ;

      $session->getSession()->set("panier", $panier) ;
       //dd($panier);

        return $this->redirectToRoute("app_produit_index",[], Response::HTTP_SEE_OTHER);         //redirection vers la page des produits
       
    }



    #[Route('/show', name: 'app_cart_show')]
    public function show(ProduitRepository $produitRepository, RequestStack $session): Response
    {
        // $session->getSession()->get("panier",[]);
       $panier = $session->getSession()->get("panier");

        $panier_complet=[];





        $total=0;
                                //key                  value
        foreach ($panier as $produit_selectionne => $quantite) {
            $selection_achat = $produitRepository->find($produit_selectionne);


            $panier_complet[]=[
                'produit' => $produitRepository->find($produit_selectionne),
                'quantite'=>$quantite,
                'total' => ($selection_achat->getPrix()*$quantite),
            ];

            $total = $total + ($selection_achat->getPrix()*$quantite);
        }

        return $this->render('cart/index.html.twig', [
            'panier' => $panier_complet,
        ]);
    }


    #[Route('/clear', name: 'app_cart_clear')]
    public function clear(RequestStack $session) : Response
    {
        dd($session->getSession()->remove("panier",[]));

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
