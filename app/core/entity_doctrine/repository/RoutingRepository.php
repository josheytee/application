<?php

namespace app\core\entity_doctrine\repository;

use Doctrine\ORM\EntityRepository;

/**
 * RoutingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoutingRepository extends EntityRepository
{

    public function deleteAll()
    {
        foreach ($this->findAll() as $entity) {
            $this->getEntityManager()->remove($entity);
        }
        $this->getEntityManager()->flush();
    }

}
