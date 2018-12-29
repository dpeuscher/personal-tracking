<?php

namespace App\Repository;

use App\Entity\ActivityEntry;
use Shopping\ApiTKUrlBundle\Repository\ApiToolkitRepository;

/**
 * @method ActivityEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActivityEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActivityEntry[]    findAll()
 * @method ActivityEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityEntryRepository extends ApiToolkitRepository
{
    // /**
    //  * @return ActivityEntry[] Returns an array of ActivityEntry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ActivityEntry
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
