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
	 * @param string                  $connectionName
	 * @param string                  $userClass
	 */
	public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $usernameCanonicalizer,
	                            CanonicalizerInterface $emailCanonicalizer, RegistryInterface $doctrine, $connectionName, $userClass)
	{
	    $om = $doctrine->getEntityManager($connectionName);
	    parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer, $om, $userClass);
	}
	
	/**
	 * Just for test
	 * @return EntityManager
	 */
	public function getObjectManager()
	{
	    return $this->objectManager;
	}
}