<?php

/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:35:27
 */
namespace AppBundle\Models;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\ItemDBService;
use AppBundle\Entity\Item;
use AppBundle\Entity\Category;

class ItemModel
{

	private $items;
    private $dbManager;
    const BY_DATE = 'date';
    const BY_VIEW = 'view';
    const BY_NAME = 'ItemName';

	function __construct(ManagerRegistry $doctrine)
	{
        $this->dbManager = new ItemDBService($doctrine);
	}

	function __destruct()
	{
	}

    public function addItem(Category $category,
                            string $name,
                            string $image,
                            string $itemDescription,
                            string $manufacturer,
                            int $price,
                            bool $isAvailable,
                            bool $isNew,
                            int $itemCount
    ) {
        $item = new Item( $category, $name, $image, $itemDescription, $manufacturer, $price,
            $isAvailable, $isNew, $itemCount);
        //$this->setSimilarArticles($article, $similar);
        $this->dbManager->addItem($item);
    }

    public function deleteItem(int $id)
    {
        $item = $this->getItemById($id);
        if ($item != null) {
            $this->dbManager->deleteItem($item);
        }
    }

    public function updateItem(
                                int $id,
                                Category $category,
                               string $name,
                               string $image,
                               string $itemDescription,
                               string $manufacturer,
                               int $price,
                               bool $isAvailable,
                               bool $isNew,
                               int $itemCount
    ) {
        $item = $this->getItemById($id);
        $item->setCategory($category);
        $item->setName($name);
        $item->setImage($image);
        $item->setDescription($itemDescription);
        $item->setManufacturer($manufacturer);
        $item->setPrice($price);
        $item->setAvailable($isAvailable);
        $item->setIsNew($isNew);
        $item->setCount($itemCount);

        //$this->setSimilarItems($item, $similar);
        $this->dbManager->updateItem($item);
    }

    public function updateItemByItem(Item $item){
        $this->dbManager->updateItem($item);
    }

    public function getItemById(int $id):? Item
    {
        return $this->dbManager->getItemById($id);
    }

    public function getItemByCategory(int $category): array
    {
        return $this->dbManager->getItems($category,self::BY_NAME);
    }

    //public function getItemsByDate(?int $category): array
    //{
    //    return $this->dbManager->getItems($category, self::BY_DATE);
    //}

    //public function getItemsByView(?int $category): array
    //{
    //    return $this->dbManager->getItems($category, self::BY_VIEW);
    //}

    public function getAllItems(): array
    {
        return $this->dbManager->getAllItems();
    }

    public function DecreaseItemCount(Item $item):Item{
	    $item->setCount($item->getCount()-1);
	    return $item;
    }

    //public function decreaseCount(Item $item)
    //{
    //    $this->dbManager->decreaseCount($item);
   // }
    /*private function setSimilarItems(Item $item, array $similar)
    {
        $similar = array_unique($similar);
        $similarItems = [];
        foreach ($similar as $itemId) {
            if ($itemId != null) {
                $itemNews[] = $this->getItemById($itemId);
            }
        }
        $item->setSimilarItems($similarItems);
    }
*/

}
?>