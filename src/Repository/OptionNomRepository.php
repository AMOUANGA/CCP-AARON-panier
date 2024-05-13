<?php

namespace App\Repository;

use App\Entity\OptionNom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OptionNom>
 *
 * @method OptionNom|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionNom|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionNom[]    findAll()
 * @method OptionNom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionNomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionNom::class);
    }

//    /**
//     * @return OptionNom[] Returns an array of OptionNom objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OptionNom
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
