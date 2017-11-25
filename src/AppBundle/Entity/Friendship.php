<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendship
 *
 * @ORM\Table(name="app_friendship")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FriendshipRepository")
 */
class Friendship
{
    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="myFriends")
     * @ORM\Id
     */
    private $user;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="friendsWithMe")
     * @ORM\Id
     */
    private $friend;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_accepted", type="boolean")
     */
    private $isAccepted;

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Friendship
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set friend
     *
     * @param integer $friend
     *
     * @return Friendship
     */
    public function setFriend($friend)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return int
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Set isAccepted
     *
     * @param boolean $isAccepted
     *
     * @return Friendship
     */
    public function setIsAccepted($isAccepted)
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    /**
     * Get isAccepted
     *
     * @return bool
     */
    public function getIsAccepted()
    {
        return $this->isAccepted;
    }
}

