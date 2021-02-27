<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiProduitController extends AbstractController
{
    /**
     * @Route("/api/produit", name="api_produit_index", methods={"GET"})
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produits = $produitsRepository->findAll();

        dd($produits);

        /*return $this->render('api_produit/index.html.twig', [
            'controller_name' => 'ApiProduitController',
        ]);*/
    }
}
