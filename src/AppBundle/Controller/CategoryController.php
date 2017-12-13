<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Models\OrderItemModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Models\ItemModel;
use AppBundle\Models\Order;
use AppBundle\Models\CategoryModel;
use AppBundle\Models\FavoritesItemsModel;
/**
 * Description of CategoryController
 *
 * @author yuriy
 */
class CategoryController extends Controller
{
    /**
     * @Route("/details", name="details")
     * @Method("GET")
     */
    public function detailsAction(ItemModel $itemManager, CategoryModel $categoryManager/**/)
    {
        echo 'details';
        return $this->render('details/items.html.twig', [
            'user' => $this->getUser(),
            'categories' => $categoryManager->getSubCategories(null),
            'details' => $itemManager->getAllItems(),
            'type' => 'details',
            'typeCategory' => 'detailsByCategory'
        ]);
    }
    /**
     * @Route("/details/{category}", name="detailsByCategory")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function ItemsByCategoryAction(
        ItemModel $itemManager,
        CategoryModel $categoryManager,
        string $category
    ) {
        $category = $categoryManager->getCategoryByName($category);
        if ($category == null) {
            throw $this->createNotFoundException('The page does not exist.');
        }
        return $this->render('details/items.html.twig', [
            'user' => $this->getUser(),
            'categories' => $categoryManager->getSubCategories($category->getId()),
            'details'=>$itemManager->getItemByCategory($category->getId()),
            //'details' => $itemManager->getArticlesByDate($category->getId()),
            'type' => 'details',
            'typeCategory' => 'detailsByCategory'
        ]);
    }

    /**
     * @Route("/ItemPage/{page}", name="ItemPage", requirements={"page": "\d+"})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function ItemPageAction(ItemModel $itemManager, CategoryModel $categoryManager, int $page)
    {
        //$item = $itemManager->getArticleById($page);
        $item=$itemManager->getItemById($page);
        if ($item == null) {
            throw $this->createNotFoundException('The page does not exist.');
        }
        //$itemManager->increaseView($item);
        return $this->render('details/itemPage.html.twig', [
            'user' => $this->getUser(),
            'categories' => $categoryManager->getSubCategories($item->getCategory()->getId()),
            'detail' => $item,
            'type' => 'details',
            'typeCategory' => 'detailsByCategory',
            'edit' => true
        ]);
    }

    /**
     * @Route("/delete/{page}", name="delete", requirements={"page": "\d+"})
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function DeleteItemAction(ItemModel $itemManager, CategoryModel $categoryManager, int $page)
    {
        echo 'delete';
        return $this->render('base.html.twig', [
        ]);
    }
    /**
     * @Route("/addToCart/{page}", name="addToCart", requirements={"page": "\d+"})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function AddToCart(ItemModel $itemManager, CategoryModel $categoryManager, int $page)
    {
        echo 'add to cart';
        return $this->render('base.html.twig', [
        ]);
    }
    /**
     * @Route("/addToOrder/{page}", name="addToOrder", requirements={"page": "\d+"})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function AddToOrder(ItemModel $itemManager,OrderItemModel $orderManager, int $page)
    {


        $item=$itemManager->getItemById($page);
        if ($item->getCount()==0)
        {
            $item->setAvailable(false);
            $itemManager->updateItemByItem($item);
            echo 'item is no available';
            return $this->render('base.html.twig', [
            ]);
        }
        $itemManager->DecreaseItemCount($item);
        $itemManager->updateItemByItem($item);
        $orderManager->addOrder($item,$this->getUser());


        echo 'add to order';
        return $this->render('base.html.twig', [
        ]);
    }
    /**
     * @Route("/addToFavorites/{page}", name="addToFavorites", requirements={"page": "\d+"})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function AddToFavorites(ItemModel $itemManager, FavoritesItemsModel $favoritesManager, int $page)
    {
        $item=$itemManager->getItemById($page);
        $favoritesManager->addItem($item,$this->getUser());
        echo 'add to favorites '.$item->getName();
        return $this->render('base.html.twig', [
        ]);
    }

}
