<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.11.17
 * Time: 0.54
 */

namespace AppBundle\DBService;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\Item;

class ItemDBService
{
    private $db;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->db = $doctrine->getManager();
    }

    public function addItem(Item $item)
    {
        //$article->setDate($this->getTime());
        $this->db->persist($item);
        $this->db->flush();
    }

    public function deleteItem(Item $item)
    {
        $this->db->remove($item);
        $this->db->flush();
    }

    public function updateItem(Item $item)
    {
        $this->db->persist($item);
        $this->db->flush();
    }

    public function getItemById(int $id):? Item
    {
        return $this->db
            ->getRepository('AppBundle\Entity\Item')
            ->findOneBy(['id' => $id]);
    }

    public function getItems(?int $category, string $criteria): array
    {
        $repository = $this->db->getRepository('AppBundle\Entity\Item');
        if ($category == null) {
            return $repository->findBy(
                [],
                [$criteria => 'DESC']
            );
        } else {
            return $repository->findBy(
                ['category' => $category],
                [$criteria => 'DESC']
            );
        }
    }

    public function getAllItems(): array
    {
        return $this->db
            ->getRepository('AppBundle\Entity\Item')
            ->findBy([], ['ItemName' => 'ASC']);
    }
/*
    public function increaseView(Item $item)
    {
        //$article->increaseView();
        $this->db->persist($item);
        $this->db->flush();
    }
    /**
    private function getTime(): \DateTime
    {
    return new \DateTime();
    }
     **/
}