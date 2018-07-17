<?php

namespace VectorXHD\TrophyBundle\Manager;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use VectorXHD\TrophyBundle\Entity\Badge;
use VectorXHD\TrophyBundle\Entity\BadgeUnlock;
use VectorXHD\TrophyBundle\Entity\UserTrophyInterface;
use VectorXHD\TrophyBundle\Event\TrophyUnlockedEvent;
use VectorXHD\TrophyBundle\Repository\BadgeRepository;
use VectorXHD\TrophyBundle\Repository\BadgeUnlockRepository;

class TrophyManager
{
    /**
     * @var BadgeRepository
     */
    private $badgeRepository;
    /**
     * @var BadgeUnlockRepository
     */
    private $badgeUnlockRepository;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * TrophyManager constructor.
     * @param BadgeRepository $badgeRepository
     * @param BadgeUnlockRepository $badgeUnlockRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(BadgeRepository $badgeRepository, BadgeUnlockRepository $badgeUnlockRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->badgeRepository = $badgeRepository;
        $this->badgeUnlockRepository = $badgeUnlockRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param UserTrophyInterface $user
     * @param string $action_name
     * @param int $action_count
     */
    public function checkAndUnlock(UserTrophyInterface $user, string $action_name, int $action_count): void
    {
        /** @var Badge $badge */
        try {
            $badge = $this->badgeRepository->findUnlockableBadge($action_name, $action_count, $user);

            if($badge->getUnlocks()->isEmpty()) {
                $unlock = new BadgeUnlock();
                $unlock->setBadge($badge);
                $unlock->setUser($user);

                $this->eventDispatcher->dispatch(TrophyUnlockedEvent::PRE_CREATE, new TrophyUnlockedEvent($unlock));
                $this->badgeUnlockRepository->save($unlock);
                $this->eventDispatcher->dispatch(TrophyUnlockedEvent::POST_CREATE, new TrophyUnlockedEvent($unlock));
            }

        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }
    }

    /**
     * @param UserTrophyInterface $user
     * @return Badge[]
     */
    public function getBadgesForUser(UserTrophyInterface $user) {
        return $this->badgeRepository->findUnlockedBadgeForUser($user);
    }
}