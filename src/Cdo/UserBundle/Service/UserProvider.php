<?php

namespace Cdo\UserBundle\Service;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Cdo\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class UserProvider implements UserProviderInterface
{
    protected $managerRegistry;
    protected $container;

    public function __construct(ManagerRegistry $managerRegistry, Container $container)
    {
        $this->managerRegistry = $managerRegistry;
        $this->container = $container;
    }
    
    public function loadUserByUsername($username)
    {
        $managerRegistry = $this->managerRegistry;
//        $manager_name = $this->container->get('session')->get('manager_name');
        
        $user = $managerRegistry->getRepository('CdoUserBundle:User')
                                ->loadUserByUsername($username);

        if ($user) {
            $user_new = new User;
            $user_new->setUsername($user->getUsername());
            $user_new->setPassword($user->getPassword());
            $user_new->setSalt($user->getSalt());
            $user_new->setIsActive($user->getIsActive());
            $user_new->setRoles($user->getRoles());
            
            return $user_new;
        }

        throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Cdo\UserBundle\Entity\User';
    }
}