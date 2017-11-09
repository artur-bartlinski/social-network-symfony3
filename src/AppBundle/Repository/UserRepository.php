<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 */
class UserRepository extends EntityRepository
{
    public function findByQuery($userName)
    {
        $userName = '%' . $userName . '%';

        $query = $this->createQueryBuilder('b')
            ->where('b.username like :username')
            ->setParameter('username', $userName)
            ->getQuery();

        $results = $query->getResult();

        return $results;
    }
}
