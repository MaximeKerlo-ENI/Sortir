<?php

namespace App\Repository;

use App\Entity\Lieux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lieux>
 *
 * @method Lieux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lieux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lieux[]    findAll()
 * @method Lieux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lieux::class);
    }

    public function add(Lieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Lieux[] Returns an array of Lieux objects
     */
    public function findByVillesNoVille($index): array{
        $queryBuilder = $this->createQueryBuilder("l");
        $queryBuilder->andWhere("l.villesNoVille = :index");     
        $query = $queryBuilder->getQuery();
        $query->setParameter("index",$index);
        return $query->getResult();
       ;
    }

    /**
     * @return Lieux Returns an occuration of Lieux objects
     */
    public function findById($id): Lieux{
        $queryBuilder = $this->createQueryBuilder("l");
        $queryBuilder->andWhere("l.noLieu = :id");     
        $query = $queryBuilder->getQuery();
        $query->setParameter("id",$id);
        return $query->getOneOrNullResult();
       ;
    }

//    /**
//     * @return Lieux[] Returns an array of Lieux objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lieux
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
