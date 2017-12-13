<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:06
 */
/**
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="finalPrice", type="integer")
     */
	private $finalPrice;
    /**
     * @ORM\Column(name="isClose", type="boolean")
     */
	private $isClose;
    /**
     * @ORM\Column(name="isPayed", type="boolean")
     */
	private $isPayed;

    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
	private $item;

	/**
     * @ORM\OneToOne(targetEntity="User", inversedBy="order")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
	private $user;

	function __construct(Item $item,
                         User $user,
                         int $price,
                         bool $isPayed,
                         bool $isClose)
	{
	    $this->item=$item;
	    $this->user=$user;
	    $this->finalPrice=$price;
	    $this->isPayed=$isPayed;
	    $this->isClose=$isClose;
	}

	function __destruct()
	{
	}


    public function getId(): int
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setItem(Item $item)
    {
        $this->item = $item;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setPrice(int $price)
    {
        $this->finalPrice = $price;
    }

    public function getPrice(): int
    {
        return $this->finalPrice;
    }

    public function setPayed(bool $payed)
    {
        $this->isPayed = $payed;
    }

    public function getPayed(): bool
    {
        return $this->isPayed;
    }

    public function setClose(bool $isClose)
    {
        $this->isClose = $isClose;
    }

    public function getClose(): bool
    {
        return $this->isClose;
    }


}
?>