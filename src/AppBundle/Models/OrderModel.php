<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.11.17
 * Time: 12.59
 */

namespace AppBundle\Models;

use AppBundle\Entity\User;
use AppBundle\Entity\Item;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\OrderDBService;
use AppBundle\Entity\Order;

class OrderModel
{
    private $dbManager;

    function __construct(ManagerRegistry $doctrine)
    {
        $this->dbManager = new OrderDBService($doctrine);
    }

    public function addOrder(Item $item,User $user,int $price,bool $isPayed,bool $isClose) {
        $order= new Order($item,$user,$price,$isPayed,$isClose);
        $this->dbManager->addOrder($order);
    }

    public function deleteItem(int $id)
    {
        $oder = $this->getOrderById($id);
        if ($oder != null) {
            $this->dbManager->deleteOrder($oder);
        }
    }

    public function updateOrder(int $id,Item $item,User $user,int $price,bool $isPayed,bool $isClose) {
        $order = $this->getOrderById($id);
        $order->setPrice($price);
        $order->setClose($isClose);
        $order->setItem($item);
        $order->setPayed($isPayed);
        $order->setUser($user);


        $this->dbManager->updateOrder($order);
    }

    public function getOrderById(int $id):? Order
    {
        return $this->dbManager->getOrderById($id);
    }

    public function getOrderByUser(User $user):? Order
    {
        return $this->dbManager->getOrderByUser($user);
    }
}