<?php

namespace Cdo\SiteBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SubdomainListener extends \Twig_Extension
{
    protected $container;
    protected $doctrine;
    
    public function __construct(Container $container, RegistryInterface $doctrine)
    {
        $this->container = $container;
        $this->doctrine = $doctrine;
    }
    
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $params = $request->attributes->get('_route_params');
        
        $session = $this->container->get('session');
        if ($params) {
            if (array_key_exists('subdomain', $params)) {
                $subdomain = $params['subdomain'];
                $connection = $this->doctrine->getManager()->getRepository('ApmAccountBundle:Account')
                                   ->findSubdomain($subdomain)->getConnection();

                $session->set('subdomain', $subdomain);
                $session->set('manager_name', 'manager_'.(string)$connection);
            }
        } else {
            $session->set('manager_name', 'manager_apm');
        }
        $session->save();
    }
    
    public function getName()
    {
        return 'listener.subdomain_listener';
    }
}