<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=64, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[A-Z]{1}[a-z]+$/",
     *     message="First name is not valid. You can use only letters and it must start
                   from capital letter, e.g. Jeremy"
     * )
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=64, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[A-Z]{1}[a-z]+$/",
     *     message="Last name is not valid. You can use only letters and it must start
                   from capital letter, e.g. Smith"
     * )
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=128, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[A-Z]{1}[A-Za-z0-9, ]+$/",
     *     message="Location is not valid. You can use only letters, numbers, comma
                   or space and it must start from capital letter, e.g. London, UK"
     * )
     */
    private $location;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getAvatarUrl()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->getEmail()) . '?d=mm&s=100';
    }
}