<?php

namespace model;

/**
 * RouteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RouteRepository extends \Doctrine\ORM\EntityRepository {

    public function findWhereUser($id_user) {
        return $this->createQueryBuilder('r')
                        ->leftJoin('p.users', 'u')
                        ->where('t.name IN (:tagNames)')
        ;
    }

}