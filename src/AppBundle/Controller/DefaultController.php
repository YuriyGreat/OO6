<?php

namespace AppBundle\Controller;


use AppBundle\Models\OrderItemModel;
use AppBundle\Models\FavoritesItemsModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request,AuthenticationUtils $authUtils)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('details');
        }
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        echo 'logout';
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/account/{email}", name="account")
     */
    public function accountAction(string $email)
    {
        echo 'account '.$email;
        return $this->render('account/userAcc.html.twig', [
            'user'=>$this->getUser(),
        ]);
    }

    /**
     * @Route("/favorites/{email}", name="favorites")
     */
    public function favoritesAction(string $email, FavoritesItemsModel $favoritesManager)
    {
        echo 'favorites '.$email;
        $items=$favoritesManager->getItemByUser($this->getUser());
        return $this->render('account/favorites.html.twig', [
            'user'=>$this->getUser(),
            'items'=>$items,
        ]);
    }
    /**
     * @Route("/orders/{email}", name="orders")
     */
    public function ordersAction(string $email, OrderItemModel $orderManager)
    {
        echo 'orders '.$email;

        $items=$orderManager->getOrderByUser($this->getUser());

        return $this->render('account/order.html.twig', [
            'user'=>$this->getUser(),
            'items'=>$items,
        ]);
    }
}
