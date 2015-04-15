<?php

namespace Cdo\UserBundle\Controller\Visitor;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cdo\UserBundle\Entity\User;
use Cdo\UserBundle\Form\Visitor\User\RegistrationType;

/**
 * @Route("/")
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="cdo_user_visitor_registration_register")
     * @Template()
     */
    public function registerAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = new User;
        $user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $user->setRoles(array('ROLE_USER'));
        
        $form = $this->createForm(new RegistrationType, $user);
        
        $request = $this->get('request');
        
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            
            if($form->isValid())
            {
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
                $user->setPassword($password);
                
                $em->persist($user);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', 'L\'utilisateur « '.$user->getUsername().' » a été créé.');
                
                return $this->redirect($this->generateUrl('apm_site_visitor_site_homepage'));
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
}
