<?php
/**
 * Created by PhpStorm.
 * User: yuriy
 * Date: 27.11.17
 * Time: 1.06
 */

namespace AppBundle\Models;


use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\CategoryDBService;
use AppBundle\Entity\Category;

class CategoryModel
{
    private $dbManager;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->dbManager = new CategoryDBService($doctrine);
    }

    public function addCategory(string $name, ?string $parent)
    {
        if ($parent == null) {
            $parentCategory = null;
        } else {
            $parentCategory = $this->dbManager->getCategoryByName($parent);
        }
        $category = new Category($name, $parentCategory);
        $this->dbManager->addCategory($category);
    }

    public function getCategoryByName(string $name):? Category
    {
        return $this->dbManager->getCategoryByName($name);
    }

    public function isCategoryExist(string $name): bool
    {
        return $this->dbManager->isCategoryExist($name);
    }

    public function getSubCategories(?int $category): array
    {
        return $this->dbManager->getSubCategories($category);
    }

    public function getAllCategories(): array
    {
        return $this->dbManager->getAllCategories();
    }
}