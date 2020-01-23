<?php
/**
 * User: michaelgtfr
 */

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function commentArticle($id, $firstNumberItem)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.article = :id')
            ->setParameter('id', $id)
            ->leftJoin('c.author', 'u')
            ->addSelect('c.dateCreate')
            ->addSelect('c.comment')
            ->addSelect('u.name')
            ->addSelect('u.picture')
            ->setMaxResults(10)
            ->setFirstResult($firstNumberItem)
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function countCommentArticle($id)
    {
            return $this->createQueryBuilder('c')
                ->select('count(c.article)')
                ->andWhere('c.article = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleScalarResult();
    }
}
