<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function getMovieAndReviews(int $id){
        $qb = $this->createQueryBuilder("m");
        $qb->andWhere("m.id = :id");

        $qb->leftJoin("m.reviews", "r");
        $qb->addSelect('r');

        $query = $qb->getQuery();
        $query->setParameter("id", $id);
        $result = $query->getResult();

        return $result;
    }

    public function search(?string $q = null){
        $qb = $this->createQueryBuilder("m");
        if(!empty($q)){
            $qb->andWhere(" m.title LIKE :q
                        OR m.actors LIKE :q
                        or m.directors LIKE :q");
        }

        $qb->addOrderBy("m.rating", "DESC");
        $qb->leftJoin("m.reviews", "r");
        $qb->addSelect('r');

        $query = $qb->getQuery();

        /*$dql = "SELECT m FROM App\Entity\Movie m
                WHERE m.title LIKE :q 
                OR m.actors LIKE :q 
                or m.directors LIKE :q 
                ORDER BY m.rating";

        $query = $this->getEntityManager()->createQuery($dql);*/
        if(!empty($q)) {
            $query->setParameter("q", "%" . $q . "%");
        }
        $query->setMaxResults(30);
        $results = $query->getResult();

        return $results;
    }

//    /**
//     * @return Movie[] Returns an array of Movie objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
