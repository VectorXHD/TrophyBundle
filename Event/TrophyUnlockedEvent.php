<?php

namespace VectorXHD\TrophyBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use VectorXHD\TrophyBundle\Entity\Badge;
use VectorXHD\TrophyBundle\Entity\BadgeUnlock;
use VectorXHD\TrophyBundle\Entity\UserTrophyInterface;

class TrophyUnlockedEvent extends Event
{
    const PRE_CREATE = 'trophy_pre_create';
    const POST_CREATE = 'trophy_post_create';

    /**
     * @var BadgeUnlock
     */
    private $badgeUnlock;

    public function __construct(BadgeUnlock $badgeUnlock)
    {
        $this->badgeUnlock = $badgeUnlock;
    }

    /**
     * @return BadgeUnlock
     */
    public function getBadgeUnlock()
    {
        return $this->badgeUnlock;
    }

    /**
     * @return null|Badge
     */
    public function getBadge()
    {
        return $this->badgeUnlock->getBadge();
    }

    /**
     * @return null|UserTrophyInterface
     */
    public function getUser()
    {
        return $this->badgeUnlock->getUser();
    }
}