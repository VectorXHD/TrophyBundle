<?php

namespace VectorXHD\TrophyBundle\Entity;

/**
 * Badge
 */
class Badge
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $actionName;

    /**
     * @var int
     */
    private $actionCount;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $unlocks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->unlocks = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name.
     *
     * @param string $name
     *
     * @return Badge
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set actionName.
     *
     * @param string $actionName
     *
     * @return Badge
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    /**
     * Get actionName.
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * Set actionCount.
     *
     * @param int $actionCount
     *
     * @return Badge
     */
    public function setActionCount($actionCount)
    {
        $this->actionCount = $actionCount;

        return $this;
    }

    /**
     * Get actionCount.
     *
     * @return int
     */
    public function getActionCount()
    {
        return $this->actionCount;
    }

    /**
     * Add unlock.
     *
     * @param \VectorXHD\TrophyBundle\Entity\BadgeUnlock $unlock
     *
     * @return Badge
     */
    public function addUnlock(\VectorXHD\TrophyBundle\Entity\BadgeUnlock $unlock)
    {
        $this->unlocks[] = $unlock;

        return $this;
    }

    /**
     * Remove unlock.
     *
     * @param \VectorXHD\TrophyBundle\Entity\BadgeUnlock $unlock
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUnlock(\VectorXHD\TrophyBundle\Entity\BadgeUnlock $unlock)
    {
        return $this->unlocks->removeElement($unlock);
    }

    /**
     * Get unlocks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnlocks()
    {
        return $this->unlocks;
    }
}
