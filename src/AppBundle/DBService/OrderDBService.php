<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.11.17
 * Time: 23.59
 */

namespace AppBundle\DBService;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Order;
use AppBundle\Entity\User;

class OrderDBService
{
    private $db;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->db = $doctrine->getManager();
    }


    public function addOrder(Order $order)
    {
        //$article->setDate($this->getTime());
        $this->db->persist($order);
        $this->db->flush();
    }

    public function deleteOrder(Order $order)
    {
        $this->db->remove($order);
        $this->db->flush();
    }

    public function updateOrder(Order $order)
    {
        $this->db->persist($order);
        $this->db->flush();
    }

    public function getOrderById(int $id):? Order
    {
        return $this->db
            ->getRepository('AppBundle\Entity\Order')
            ->findOneBy(['id' => $id]);
    }

    public function getOrderByUser(User $user):? Order{
        return $this->db
            ->getRepository('AppBundle\Entity\Order')
            ->findOneBy(['user' => $user->getId()]);
    }

}