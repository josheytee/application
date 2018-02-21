<?php


namespace app\core\entity_doctrine\repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class BaseRepository extends EntityRepository
{
    public function paginate($page, $no_per_page = 10)
    {
        $dql = "SELECT e FROM {$this->getEntityName()} e WHERE e.id > 0";
        /*JOIN p.comments c*/
        $page = $page - 1;
        $offset = 0;
        if ($page > 0) {
            $offset = $page * $no_per_page;
        }
        $query = $this->getEntityManager()->createQuery($dql)
            ->setFirstResult($offset)
            ->setMaxResults($no_per_page);
        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $count = count($paginator);
        $totalPages = ceil($count / $no_per_page);
        if ($page * $no_per_page > $count) {
            $totalPages = $page;
        }
        $return = [
            'data' => $paginator,
            'templateData' => [
                'currentPage' => (int)$page + 1,
                'totalPages' => (int)$totalPages
            ]
        ];
        return $return;
    }
}