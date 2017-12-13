<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 28.11.17
 * Time: 15.41
 */

namespace AppBundle\Models;

use AppBundle\Entity\User;
use AppBundle\Entity\Item;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\FavoritesItemDBService;
use AppBundle\Entity\FavoritesItems;

class FavoritesItemsModel
{
    private $dbManager;

    function __construct(ManagerRegistry $doctrine)
    {
        $this->dbManager = new FavoritesItemDBService($doctrine);
    }

    public function addItem(Item $item,User $user) {
        $favorites= new FavoritesItems($item,$user);
        $this->dbManager->addItem($favorites);
    }

    public function deleteItem(int $id)
    {
        $favorites = $this->getItemById($id);
        if ($favorites != null) {
            $this->dbManager->deleteItem($favorites);
        }
    }

    public function updateItem(int $id,Item $item,User $user) {
        $order = $this->getItemById($id);
        $order->setItem($item);
        $order->setUser($user);

        $this->dbManager->updateItem($order);
    }

    public function getItemById(int $id):? FavoritesItems
    {
        return $this->dbManager->getItemById($id);
    }

    public function getItemByUser(User $user):? array
    {
        return $this->dbManager->getItemByUser($user);
    }
}