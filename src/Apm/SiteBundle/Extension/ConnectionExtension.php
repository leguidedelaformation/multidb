<?php

namespace Apm\SiteBundle\Extension;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class ConnectionExtension extends \Twig_Extension
{
    protected $container;
    protected $doctrine;
    
    public function __construct(Container $container, RegistryInterface $doctrine)
    {
        $this->container = $container;
        $this->doctrine = $doctrine;
    }

    public function encode()
    {
        $em = $this->doctrine->getManager();
        $account_array = $em->getRepository('ApmAccountBundle:Account')->connectionAll();
        
//        $connection_array = array(
//    	    'site' => array(
//    	        'title' => $account->getTitle(),
//    	        'slogan' => 'Le meilleur de la formation',
//    	    ),
//    	    'social' => array(
//    	        'color' => 'lightgrey',
//    	        'facebook' => '#',
//    	        'twitter' => '#',
//    	        'google' => '#',
//    	        'linkedin' => '#',
//    	    ),
//    	    'page' => array(
//    	        'placement' => '_tree_content',
//    	    ),
//    	    'blog' => array(
//    	        'title' => 'Blog',
//    	        'menurank' => 1,
//    	        'placement' => '_tree_content',
//    	    ),
//    	);
    	$connection_array = array();
    	foreach ($account_array as $account) {
//    		$connection_array[] = $account->getSubdomain();
    		$connection_array[$account->getSubdomain()] = array(
    		    'number' => $account->getConnection(),
    		    'database_user' => 'root',
    		    'database_password' => 'root',
    		);
//    		$connection_array[] = array(
//    		    $account->getSubdomain() => $account->getConnection(),
//    		);
    	}
        
        $connection_encoded = json_encode($connection_array, JSON_PRETTY_PRINT);
        
        $directory = $this->container->get('kernel')->getRootDir().'/config';

        if (!file_exists($directory)) {
            mkdir($directory, 0775, true);
        }
        $path = $directory.'/connection.json';
        $connection_file = fopen($path, 'w') or die("Unable to open file!");
        fwrite($connection_file, $connection_encoded);
        return fclose($connection_file);
    }
    
    public function getName()
    {
        return 'connection_extension';
    }
}