<?php

namespace Cdo\UserBundle\Tests\FOSUser;

use Cdo\UserBundle\Service\UserManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * phpunit -c app/ src/Cdo/UserBundle/Tests/FOSUser/FOSUserMultiConnection.php
 */
class FOSUserMultiConnection extends WebTestCase
{
    public function test1()
    {
        $client = static::createClient();
        
        $user_manager_connection_apm = $client->getContainer()->get('cdo_user.user_manager.connection_apm');
        
        $user_manager_connection_0 = $client->getContainer()->get('cdo_user.user_manager.connection_0');
        
        $om1 = $user_manager_connection_apm->getObjectManager();
        
        $om2 = $user_manager_connection_0->getObjectManager();
        
        $this->assertNotEquals($om1->getConnection()->getDatabase(), $om2->getConnection()->getDatabase());
    }
}