<?php

namespace App\Service;


use App\Entity\Fruits;
use App\Repository\FruitsRepository;
use Doctrine\ORM\EntityManagerInterface;

class FruitsService
{
    private $fruitsRepository;
    private $entityManager;

    public function __construct(FruitsRepository $fruitsRepository, EntityManagerInterface $entityManager)
    {
        $this->fruitsRepository = $fruitsRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllFruits()
    {
        $fruits = $this->fruitsRepository->findAll();
        $rows = array_map(function ($fruit) {
            return [
                'id' => $fruit->getId(),
                'genus' => $fruit->getGenus(),
                'name' => $fruit->getName(),
                'family' => $fruit->getFamily(),
                'order' => $fruit->getOrder(),
                'nutritions' => $fruit->getNutritions(),
            ];
        }, $fruits);

        return $rows;
    }

    public function saveFruit($fruitData): int
    {
        $fruit = $this->entityManager->getRepository(Fruits::class)->findOneBy([
            'genus' => $fruitData['genus'],
            'name' => $fruitData['name'],
            'order' => $fruitData['order'],
        ]);
        if (!$fruit) {
            $fruit = new Fruits();
            $fruit->setName($fruitData['name']);
            $fruit->setGenus($fruitData['genus']);
            $fruit->setFamily($fruitData['genus']);
            $fruit->setOrder($fruitData['order']);

            $fruit->setNutritions([
                "carbohydrates" => $fruitData['nutritions']['carbohydrates'],
                "protein" => $fruitData['nutritions']['protein'],
                "fat" => $fruitData['nutritions']['fat'],
                "calories" => $fruitData['nutritions']['calories'],
                "sugar" => $fruitData['nutritions']['sugar']
            ]);

            $this->entityManager->persist($fruit);
            $this->entityManager->flush();
            return $fruit->getId();
        }
        return $fruit->getId();
    }

}