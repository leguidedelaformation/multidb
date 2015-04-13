<?php

namespace Cdo\UserBundle\Service;

use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager extends BaseUserManager
{
	/**
	 * Constructor.
	 *
	 * @param EncoderFactoryInterface $encoderFactory
	 * @param CanonicalizerInterface  $usernameCanonicalizer
	 * @param CanonicalizerInterface  $emailCanonicalizer
	 * @param RegistryInterface       $doctrine
	 * @param string                  $connName
	 * @param string                  $class
	 */
	public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $usernameCanonicalizer,
	                            CanonicalizerInterface $emailCanonicalizer, RegistryInterface $doctrine, $connName, $class)
	{
	    $om = $doctrine->getEntityManager($connName);
	    parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer, $om, $class);
	}
	
	/**
	 * Just for test
	 * @return EntityManager
	 */
	public function getOM()
	{
	    return $this->objectManager;
	}
}