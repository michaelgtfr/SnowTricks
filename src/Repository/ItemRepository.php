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

    /**
     * @param $firstItem
     * @param $numberOfItem
     * @return mixed
     */
    public function listOfArticle($firstItem, $numberOfItem)
    {
         return $this->getEntityManager()->createQuery(
             'SELECT i.id , i.title, p.name, p.extension, p.description 
             FROM App\Entity\Item i 
             LEFT JOIN i.pictures p 
             GROUP BY i.id 
             ORDER BY i.id DESC ')
             ->setFirstResult($firstItem)
             ->setMaxResults($numberOfItem)
            ->getResult()
             ;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countArticle()
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
