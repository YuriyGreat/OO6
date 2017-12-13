<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
/**
 * Description of AuthorisationController
 *
 * @author yuriy
 */
class AuthorisationController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function indexAction(AuthenticationUtils $authUtils)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('details');
        }
        else echo 'sada';
        $error = $authUtils->getLastAuthenticationError();
        $email = $authUtils->getLastUsername();
        return $this->render('form/signIn.html.twig', [
            'email' => $email,
            'error' => $error
        ]);
    }
}
