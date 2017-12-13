<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 29.11.17
 * Time: 15.12
 */

namespace AppBundle\DBService;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\OrderItem;
use AppBundle\Entity\User;
use AppBundle\Entity\Item;

class OrderItemDBService
{
    private $db;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->db = $doctrine->getManager();
    }

    public function addItem(OrderItem $item)
    {
        //$article->setDate($this->getTime());
        $this->db->persist($item);
        $this->db->flush();
    }

    public function deleteItem(OrderItem $item)
    {
        $this->db->remove($item);
        $this->db->flush();
    }

    public function updateItem(OrderItem $item)
    {
        $this->db->persist($item);
        $this->db->flush();
    }

    public function getItemById(int $id):? OrderItem
    {
        return $this->db
            ->getRepository('AppBundle\Entity\OrderItem')
            ->findOneBy(['id' => $id]);
    }

    public function getItemByUser(User $user):? array
    {
        $repository = $this->db->getRepository('AppBundle\Entity\OrderItem');
        return $repository->findBy(
            ['userId' => $user->getId()],
            ['itemId' => 'DESC']
        );

        //return $this->db
        //    ->getRepository('AppBundle\Entity\FavoritesItems')
        //    ->findOneBy(['userId' => $user->getId()]);
    }

    public function getItemByIdItem(Item $item):? array
    {
        $repository = $this->db->getRepository('AppBundle\Entity\OrderItem');
        return $repository->findBy(
            ['itemId' => $item->getId()],
            ['userId' => 'DESC']
        );

        //return $this->db
        //    ->getRepository('AppBundle\Entity\FavoritesItems')
        //    ->findOneBy(['userId' => $user->getId()]);
    }

}