<?php

namespace Cdo\UserBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RedirectController extends Controller
{
    /**
     * @Route("/redirect", name="cdo_user_user_redirect_login")
     */
    public function loginAction()
    {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}
