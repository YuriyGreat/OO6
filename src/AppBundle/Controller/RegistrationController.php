<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Models\RegistrationModel;
use AppBundle\Models\ActivationModel;
use AppBundle\Models\MailModel;
/**
 * Description of RegistrationController
 *
 * @author yuriy
 */

class RegistrationController extends Controller{
/**
* @Route("/registration", name="registration")
*/
    public function registrationAction(
        Request $request,
        RegistrationModel $manager,
        \Swift_Mailer $mailer
    ) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('news');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->addUser($user);
            //if ($this->sendEmail($mailer, $user)) {
                return $this->redirectToRoute('homepage');
            //}
        }
        return $this->render('form/registration.html.twig', [
            'form' => $form->createView(),
            'errors' => $form->getErrors(true, true)
        ]);
    }
}
