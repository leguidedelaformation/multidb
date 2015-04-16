<?php

namespace Apm\AccountBundle\Controller\Master;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Apm\AccountBundle\Entity\Account;
use Apm\AccountBundle\Form\Master\Account\CreateType;

/**
 * @Route("/master/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/create", name="apm_account_master_account_create")
     * @Template()
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $account_maxconnection = $em->getRepository('ApmAccountBundle:Account')
                                  ->connectionMaxvalue();
        $connection_maxvalue = ($account_maxconnection)
        	? $account_maxconnection->getConnection()
        	: 0;
        
        $account = new Account;
        $account->setConnection($connection_maxvalue + 1);
        
        $form = $this->createForm(new CreateType, $account);
        
        $request = $this->get('request');
        
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            
            if($form->isValid())
            {
                $account->setTitle(ucfirst($account->getSubdomain()));
                
                $em->persist($account);
                $em->flush();
                
                $this->get('session')->getFlashBag()->add('success', 'Le compte « '.$account->getTitle().' » a été créé.');
                
                return $this->redirect($this->generateUrl('apm_site_visitor_site_homepage'));
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
}
