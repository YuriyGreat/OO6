<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 29.11.17
 * Time: 15.19
 */

namespace AppBundle\Models;

use AppBundle\Entity\User;
use AppBundle\Entity\Item;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\OrderItemDBService;
use AppBundle\Entity\OrderItem;

class OrderItemModel
{
    private $dbManager;

    function __construct(ManagerRegistry $doctrine)
    {
        $this->dbManager = new OrderItemDBService($doctrine);
    }

    public function addOrder(Item $item,User $user) {
        $orderItem= new OrderItem($item,$user);
        $this->dbManager->addItem($orderItem);
    }

    public function deleteOrder(int $id)
    {
        $orderItem = $this->getOrderById($id);
        if ($orderItem != null) {
            $this->dbManager->deleteItem($orderItem);
        }
    }

    public function updateOrder(int $id,Item $item,User $user) {
        $orderItem = $this->getOrderById($id);
        $orderItem->setItem($item);
        $orderItem->setUser($user);
        $this->dbManager->updateItem($orderItem);
    }

    public function getOrderById(int $id):? OrderItem
    {
        return $this->dbManager->getItemById($id);
    }

    public function getOrderByUser(User $user):? array
    {
        return $this->dbManager->getItemByUser($user);
    }
    public function getOrderByItem(Item $item):? array
    {
        return $this->dbManager->getItemByIdItem($item);
    }
}