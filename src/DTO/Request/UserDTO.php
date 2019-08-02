<?php

namespace Scaleplan\YandexDirectory\DTO\Request;

use Scaleplan\DTO\DTO;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserDTO
 *
 * @package Scaleplan\YandexDirectory\DTO
 */
class UserDTO extends DTO
{
    /**
     * @var string
     *
     * @Assert\Type(type="bool", groups={"type"})
     * @Assert\NotNull()
     */
    private $isAdmin;

    /**
     * @var array
     *
     * @Assert\Type(type="array", groups={"type"})
     * @Assert\Collection(fields = {
     *     "fiest" = {
     *         @Assert\NotBlank(),
     *         @Assert\Type(type="string"),
     *         @Assert\Length(min=3)
     *     },
     *     "last" = {
     *         @Assert\NotBlank(),
     *         @Assert\Type(type="string"),
     *         @Assert\Length(min=3)
     *     },
     *     "middle" = {
     *         @Assert\Type(type="string"),
     *         @Assert\Length(min=3)
     *     },
     * }, )
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\Type(type="string", groups={"type"})
     * @Assert\Length(min=8)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @var string
     *
     * @Assert\Type(type="string", groups={"type"})
     * @Assert\Length(min=3)
     * @Assert\NotBlank()
     */
    private $nickname;

    /**
     * @return string
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param string $isAdmin
     */
    public function setIsAdmin($isAdmin) : void
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $name
     */
    public function setName($name) : void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) : void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname($nickname) : void
    {
        $this->nickname = $nickname;
    }
}
