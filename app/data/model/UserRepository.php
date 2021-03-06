<?php

namespace model;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{

    public function getList($array)
    {

//    $dql = "SELECT b, e, r FROM User b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";
//    $dql = "SELECT partial u.{" . implode(',', $array) . "} FROM " . $this->getEntityName() . " u";
        $dql = "SELECT partial u.{" . implode(',', $array) . "} ,o FROM " . $this->getEntityName() . " u JOIN u.occupations o";
//    $dql = "SELECT u FROM " . $this->getEntityName() . " u";
        $query = $this->getEntityManager()->createQuery($dql);
//    $query->setMaxResults($number);
//    return $query->getDQL();
        return $query->getResult();
    }

    public function hello()
    {
        $dql = $this->createQueryBuilder('u');
    }

}
