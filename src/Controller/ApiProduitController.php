<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiProduitController extends AbstractController
{
    /**
     * @Route("/api/produit", name="api_produit_index", methods={"GET"})
     */
    public function index(ProduitsRepository $produitsRepository, SerializerInterface $serialiser)
    {


        // $json = $serialiser->serialize($produitsRepository->findAll(), 'json', ['groups' => 'produit:read']);

        // $response = new Response($json, 200, [
        //     "Content-Type" => "application/json"
        // ]);
        // return $response;


        return $this->json($produitsRepository->findAll(), 200, [], ['groups' => 'produit:read']);
    }

    /**
     * @Route("/api/produit", name="api_add_product", methods={"POST"})
     */
    public function addProduct(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)
    {

        $jsonR = $request->getContent();
        try {
            $post = $serializer->deserialize($jsonR, Produits::class, 'json');

            $post->setCreatedAt(new \DateTime());

            $errors = $validator->validate($post);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }

            $em->persist($post);
            $em->flush();

            return $this->json($post, 201, [], ['groups' => 'produit:read']);
        } catch (NotEncodableValueException $e) {

            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
