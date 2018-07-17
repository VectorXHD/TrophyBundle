<?php

namespace VectorXHD\TrophyBundle\Entity;

/**
 * BadgeUnlock
 */
class BadgeUnlock
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Badge
     */
    private $badge;

    /**
     * @var UserTrophyInterface
     */
    private $user;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set badge.
     *
     * @param Badge|null $badge
     *
     * @return BadgeUnlock
     */
    public function setBadge(Badge $badge = null)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Get badge.
     *
     * @return Badge|null
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set user.
     *
     * @param UserTrophyInterface|null $user
     *
     * @return BadgeUnlock
     */
    public function setUser(UserTrophyInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return UserTrophyInterface|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
