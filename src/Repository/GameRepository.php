<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function add(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findGamesByName(string $query)
    {

        return $this->createQueryBuilder('g')
            ->andWhere('g.title LIKE :val')
            ->orWhere('g.description LIKE :val')
            ->setParameter('val', '%'.$query.'%')
            //->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
//        $qb = $this->createQueryBuilder('p');
//        $qb
//            ->where(
//                $qb->expr()->andX(
//                    $qb->expr()->orX(
//                        $qb->expr()->like('p.title', ':query'),
//                        $qb->expr()->like('p.content', ':query'),
//                    ),
//                    $qb->expr()->isNotNull('p.created_at')
//                )
//            )
//            ->setParameter('query', '%' . $query . '%')
//        ;
//        return $qb
//            ->getQuery()
//            ->getResult();
    }

    /**
     * @return Game[] Returns an array of Game objects
     */
    public function findByMaxNumber(): array
    {
        return $this->createQueryBuilder('a')
            //  ->andWhere('a.exampleField = :val')
            //->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?Game
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
