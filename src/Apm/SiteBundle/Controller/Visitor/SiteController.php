<?php

namespace Apm\SiteBundle\Controller\Visitor;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SiteController extends Controller
{
    /**
     * @Route("/", name="apm_site_visitor_site_homepage")
     * @Template()
     */
    public function homepageAction()
    {
        return array();
    }
}
