<?php

namespace Cdo\AccountBundle\Controller\Master;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cdo\AccountBundle\Entity\Account;
use Cdo\AccountBundle\Form\Master\Account\CreateType;

/**
 * @Route("/master/account")
 */
class AccountController extends Controller
{
    /**
     * @Route("/create", name="cdo_account_master_account_create")
     * @Template()
     */
    public function createAction()
    {
        $manager_name = $this->container->get('session')->get('manager_name');
        $em = $this->getDoctrine()->getManager($manager_name);
        
        $account = new Account;
        
        $form = $this->createForm(new CreateType, $account);
        
        $request = $this->get('request');
        
        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            
            if($form->isValid())
            {
                $em->persist($account);
                $em->flush();
                
                return $this->redirect($this->generateUrl('cdo_site_visitor_site_homepage', array(
                    'subdomain' => $this->container->get('session')->get('subdomain'),
                )));
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
}
