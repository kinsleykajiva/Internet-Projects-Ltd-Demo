<?php

namespace App\Controller;

use App\Entity\Favourates;
use App\Entity\Fruits;

use App\Repository\FavouratesRepository;
use App\Repository\FruitsRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fruits', name: 'app_fruits.')]
class FruitsController extends AbstractController
{
    #[Route('/fruits', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new index controller!',
            'path' => 'src/Controller/FruitsController.php',
        ]);
    }


    /** List All Fruits from the database
     * @param Request $req
     * @param FruitsRepository $fruitsRepository
     * @return JsonResponse
     */
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function getAllFruits(
        Request $req,
        FruitsRepository $fruitsRepository
    ): JsonResponse {
        $id = $req->query->get('id');
        $page = $req->query->get('page');
        $family = $req->query->get('family');
        $name = $req->query->get('name');
        if (empty($page) || $page < 9) {
            $page = 10;
        }
        $data = [];
        if ($id != 0) {
            $fruits = $fruitsRepository->find($id);
            if (!$fruits) {
                return $this->json([
                    'success' => false,
                    'message' => 'no fruit successfully',
                    'data' => [

                    ]

                ]);
            }
        } elseif (!empty($name) || !empty($family)) {
            $fruits = $fruitsRepository->createQueryBuilder('f')
                ->where('f.id > :page')
                ->andWhere('f.name = :name')
                ->andWhere('f.family = :family')
                ->setParameters([
                    'page' => $page,
                    'name' => $name,
                    'family' => $family,
                ])
                ->setMaxResults(10)
                ->getQuery()
                ->getResult();
        } else {
            $fruits = $fruitsRepository->createQueryBuilder('f')
                ->where('f.id > :page')
                ->setParameters([
                    'page' => $page,
                ])
                ->setMaxResults(10)
                ->getQuery()
                ->getResult();
        }

        //  dump($fruits);

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


        return $this->json([
            'success' => true,
            'message' => 'fetched fruits successfully',
            'data' => [
                'pagination' => [
                    'current_page' => $page,
                    'last_page' => ($page - 10) < 1 ? '9' : $page - 10,
                ],
                'fruits' => $rows
            ]
        ]);
    }

    /**
     * @param Request $req
     * @param FavouratesRepository $favouratesRepository
     * @return JsonResponse
     */
    #[Route('/list-favs', name: 'listfav', methods: ['GET'])]
    public function getAllFavourateFruits(
        Request $req,
        FavouratesRepository $favouratesRepository
    ): JsonResponse {
        $fruits = $favouratesRepository->findAll();

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

        return $this->json([
            'success' => true,
            'message' => 'list of all favourates ',
            'data' => [
                'fruits' => $rows
            ]
        ]);
    }

    /**
     * @param Request $req
     * @param FavouratesRepository $favouratesRepository
     * @return JsonResponse
     */
    #[Route('/delete-from-fav', name: 'deletetofav', methods: ['POST'])]
    public function deleteFromFavourate(Request $req, FavouratesRepository $favouratesRepository): JsonResponse
    {
        $fruitData = json_decode($req->getContent(), true);

        $favouratesRepository->deleteById($fruitData['id']);

        return $this->json([
            'success' => true,
            'message' => 'fruit removed from favourite successfully',
            'data' => [

                'id' => $fruitData['id']
            ]
        ]);
    }

    /** Save new Fruit Favorite
     * @param Request $req
     * @param EntityManagerInterface $entityManager
     * @param FavouratesRepository $favouratesRepository
     * @return JsonResponse
     */
    #[Route('/add-to-fav', name: 'addtofav', methods: ['POST'])]
    public function saveNewFavourate(
        Request $req,
        EntityManagerInterface $entityManager,
        FavouratesRepository $favouratesRepository
    ): JsonResponse {
        $fruits = $favouratesRepository->findAll();
        if (count($fruits) == 10) {
            return $this->json([
                'success' => false,
                'message' => 'Already full',
                'data' => null
            ]);
        }


        $fruitData = json_decode($req->getContent(), true);
        // dump($favouratesRepository->findBy([ 'fruit_id' =>$fruitData['id']]));
        if ($favouratesRepository->findBy(['fruit_id' => $fruitData['id']])) {
            return $this->json([
                'success' => false,
                'message' => 'Already saved try another one',
                'data' => null
            ]);
        }

        $fruit = new Favourates();
        $fruit->setFruitId($fruitData['id']);
        $fruit->setName($fruitData['name']);
        $fruit->setGenus($fruitData['genus']);
        $fruit->setFamily($fruitData['genus']);
        $fruit->setOrder($fruitData['order']);

        $fruit->setNutritions(
            [
                "carbohydrates" => $fruitData['nutritions']['carbohydrates'],
                "protein" => $fruitData['nutritions']['protein'],
                "fat" => $fruitData['nutritions']['fat'],
                "calories" => $fruitData['nutritions']['calories'],
                "sugar" => $fruitData['nutritions']['sugar']
            ]
        );

        $entityManager->persist($fruit);
        $entityManager->flush();

        $id = $fruit->getId();
        return $this->json([
            'success' => true,
            'message' => 'fruit save to favourate successfully',
            'data' => [

                'id' => $id
            ]
        ]);
    }

    /** Save new Fruit
     * @param Request $req
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(Request $req, EntityManagerInterface $entityManager): JsonResponse
    {
        $fruitData = json_decode($req->getContent(), true);

        $fruit = new Fruits();
        $fruit->setName($fruitData['name']);
        $fruit->setGenus($fruitData['genus']);
        $fruit->setFamily($fruitData['family']);
        $fruit->setOrder($fruitData['order']);

        $fruit->setNutritions([
            "carbohydrates" => $fruitData['nutritions']['carbohydrates'],
            "protein" => $fruitData['nutritions']['protein'],
            "fat" => $fruitData['nutritions']['fat'],
            "calories" => $fruitData['nutritions']['calories'],
            "sugar" => $fruitData['nutritions']['sugar']
        ]);

        $entityManager->persist($fruit);
        $entityManager->flush();

        $id = $fruit->getId();

        return $this->json([
            'success' => true,
            'message' => 'Saved fruit successfully',
            'data' => [
                'id' => $id
            ]

        ]);
    }
}
