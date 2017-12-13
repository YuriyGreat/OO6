<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:07
 */
/**
 * @ORM\Table(name="carts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;
    /**
     * @ORM\OneToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
	private $items;
	/**
     * @ORM\Column(name="type", type="integer")
     */
    private $finalPrice;
    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="userCart")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function CalculatePrice()
	{
	}

	public function CreateOrder()
	{
	}

	public function DeleteItem()
	{
	}

}
?>