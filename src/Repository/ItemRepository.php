<?php
/**
 * User: michaelgtfr
 */

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function listOfArticle($firstItem, $numberOfItem)
    {
      return $this->createQueryBuilder('i')
          ->leftJoin('i.pictures','p')
          ->addSelect('i.id')
          ->addSelect('i.title')
          ->addSelect('p.name')
          ->addSelect('p.extension')
          ->addSelect('p.description')
          ->orderBy('i.id', 'DESC')
          ->setFirstResult($firstItem)
          ->setMaxResults($numberOfItem)
          ->getQuery()
          ->getResult()
          ;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countArticle()
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
