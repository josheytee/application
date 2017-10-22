<?php


namespace app\core\entity\repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class BaseRepository extends EntityRepository
{
    public function paginate($page, $no_per_page = 10)
    {
        $dql = "SELECT p FROM {$this->getEntityName()} p ";
        /*JOIN p.comments c*/
        $query = $this->getEntityManager()->createQuery($dql)
//        $query = $this->findAll()
            ->setFirstResult(0)
            ->setMaxResults($no_per_page);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $c = count($paginator);

//        dump($paginator);
        return $paginator;
    }
}