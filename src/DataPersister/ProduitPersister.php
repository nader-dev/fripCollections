<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;

class ProduitPersister implements DataPersisterInterface
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function supports($data): bool
    {
        return $data instanceof Produits;
    }

    public function persist($data)
    {
        // 1. mettre une date de création sur l'article
        $data->setCreatedAt(new \DateTime());

        // 2. demander à Doctrine de persister 

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        //1. demander a doctrine de supp  article
        $this->em->remove($data);
        $this->em->flush();
    }
}
