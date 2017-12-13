<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.11.17
 * Time: 15.58
 */

namespace AppBundle\DBService;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\FavoritesItems;
use AppBundle\Entity\User;
use AppBundle\Entity\Item;

class FavoritesItemDBService
{
    private $db;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->db = $doctrine->getManager();
    }

    public function addItem(FavoritesItems $item)
    {
        //$article->setDate($this->getTime());
        $this->db->persist($item);
        $this->db->flush();
    }

    public function deleteItem(FavoritesItems $item)
    {
        $this->db->remove($item);
        $this->db->flush();
    }

    public function updateItem(FavoritesItems $item)
    {
        $this->db->persist($item);
        $this->db->flush();
    }

    public function getItemById(int $id):? FavoritesItems
    {
        return $this->db
            ->getRepository('AppBundle\Entity\FavoritesItems')
            ->findOneBy(['id' => $id]);
    }

    public function getItemByUser(User $user):? array
    {
        $repository = $this->db->getRepository('AppBundle\Entity\FavoritesItems');
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
        $repository = $this->db->getRepository('AppBundle\Entity\FavoritesItems');
        return $repository->findBy(
            ['itemId' => $item->getId()],
            ['userId' => 'DESC']
        );

        //return $this->db
        //    ->getRepository('AppBundle\Entity\FavoritesItems')
        //    ->findOneBy(['userId' => $user->getId()]);
    }

}