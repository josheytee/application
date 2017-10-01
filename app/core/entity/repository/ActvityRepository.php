<?php

namespace app\core\entity\repository;

use Doctrine\ORM\EntityRepository;

/**
 * ActvityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActvityRepository extends EntityRepository {
    public function getActivities() {
        $fields = array('a.id', 'a.name');
        $query = $this->getEntityManager()->createQueryBuilder();

        $query
          ->select($fields)
          ->from($this->getClassName(), 'a');
        $results = $query->getQuery()->getResult();
        $return = [];
        foreach ($results as $result) {
            $return += [$result['id'] => $result['name']];
        }
        return $return;
    }
}
