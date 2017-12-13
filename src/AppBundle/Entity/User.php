<?php

/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:35:59
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken.")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToOne(targetEntity="UserToken", mappedBy="user")
     */
    private $userKey;

    /**
     * @ORM\OneToOne(targetEntity="Cart", mappedBy="user")
     */
    private $userCart;

    /**
     * @ORM\OneToOne(targetEntity="Order", mappedBy="user")
     */
    private $order;

    public function getId(): int
    {
        return $this->id;
    }

    public function setUsername(string $email)
    {
        $this->email = $email;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail():? string
    {
        return $this->email;
    }

    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPlainPassword():? string
    {
        return $this->plainPassword;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setUserKey(UserToken $userKey)
    {
        $this->userKey = $userKey;
    }

    public function getUserKey():? UserToken
    {
        return $this->userKey;
    }

    public function setUserCart(Cart $cart)
    {
        $this->userCart = $cart;
    }

    public function getUserCart():? Cart
    {
        return $this->userCart;
    }
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder():? Order
    {
        return $this->order;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        return null;
    }

    public function isAccountNonExpired(): bool
    {
        return true;
    }

    public function isAccountNonLocked(): bool
    {
        return true;
    }

    public function isCredentialsNonExpired(): bool
    {
        return true;
    }

    public function isEnabled(): bool
    {
        return $this->isActive;
    }

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password,
            $this->isActive
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }



}
