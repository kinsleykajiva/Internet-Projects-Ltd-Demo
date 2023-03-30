<?php

namespace App\Repository;

use App\Entity\Favourates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favourates>
 *
 * @method Favourates|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favourates|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favourates[]    findAll()
 * @method Favourates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavouratesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favourates::class);
    }

    public function save(Favourates $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function deleteById(int $id)
    {
        $favourite = $this->find($id);

        if (!$favourite) {
            throw $this->createNotFoundException('Favourite not found');
        }

        $this->_em->remove($favourite);
        $this->_em->flush();
    }
    public function remove(Favourates $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Favourates[] Returns an array of Favourates objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Favourates
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
