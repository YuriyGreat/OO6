<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.11.17
 * Time: 17.35
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="OrderItem")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $itemId;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    function __construct(Item $item, User $user)
    {
        $this->userId=$user;
        $this->itemId=$item;

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setItemId(Item $item)
    {
        $this->itemId = $item->getId();
    }

    public function getItemId(): Item
    {
        return $this->itemId;
    }

    public function setUserId(User $user)
    {
        $this->userId = $user->getId();
    }

    public function getUserId(): User
    {
        return $this->userId;
    }

}