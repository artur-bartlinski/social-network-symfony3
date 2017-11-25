<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

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

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getFriendships($userId)
    {
        $query = $this->getEntityManager()->createQuery(
            'select f from AppBundle:Friendship f
            where ((f.user = :id or f.friend = :id) and f.isAccepted = 1)'
        )->setParameter('id', $userId);

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getFriends($user)
    {
        $userId = $user->getId();
        $username = $user->getUsername();
        $friendships = $this->getFriendships($userId);

        $friends = [];
        $counter = 0;

        foreach ($friendships as $friendship) {
            if ($friendship->getFriend()->getUsername() === $username) {
                $friends[$counter] = $friendship->getUser();
            } else {
                $friends[$counter] = $friendship->getFriend();
            }
            $counter++;
        }

        return $friends;
    }
}