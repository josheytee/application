<?php

namespace app\core\entity_doctrine\repository;

/**
 * ShopRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ShopRepository extends BaseRepository
{
//    public function getSections($id)
//    {
//        $fields = array('s.id', 's.name', 's.url','s.section as parent');
//
//        $query = $this->getEntityManager()->createQueryBuilder();
//        $or = $query->expr()->eq('s.shop', $id);
//        $query
//            ->select($fields)
//            ->from($this->getClassName(), 's')
////            ->leftjoin('s.otherEntity', 'o');
//            ->where($or);
//
////        $query->setMaxResults(10);
//        $results = $query->getQuery()->getResult();
////        $return = [];
//////        if ($default)
//////            $return += [0 => 'default section'];
////        foreach ($results as $result) {
////            $return += [$result['id'] => $result['name']];
////        }
//        return $results;
//    }
}