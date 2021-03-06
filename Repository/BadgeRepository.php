<?php

namespace VectorXHD\TrophyBundle\Repository;

use VectorXHD\TrophyBundle\Entity\Badge;
use VectorXHD\TrophyBundle\Entity\UserTrophyInterface;

/**
 * BadgeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BadgeRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $actionName
     * @param $actionCount
     * @param UserTrophyInterface $user
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findUnlockableBadge($actionName, $actionCount, UserTrophyInterface $user)
    {
        $qb = $this->createQueryBuilder('b')
            ->leftJoin('b.unlocks', 'u')
            ->select('b, u')
            ->andWhere('b.actionName = :actionName')
            ->andWhere('b.actionCount = :actionCount')
            ->andWhere('u.user = :user OR u.user IS NULL')
            ->setParameter('actionName', $actionName)
            ->setParameter('actionCount', $actionCount)
            ->setParameter('user', $user);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param UserTrophyInterface $user
     * @return Badge[]
     */
    public function findUnlockedBadgeForUser(UserTrophyInterface $user)
    {
        $qb = $this->createQueryBuilder('b')
            ->join('b.unlocks', 'u')
            ->andWhere('u.user = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }
}
