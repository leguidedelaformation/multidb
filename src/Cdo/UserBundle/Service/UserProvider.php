<?php

namespace Cdo\UserBundle\Service;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\Common\Persistence\ManagerRegistry;
use Cdo\UserBundle\Entity\User;

class UserProvider implements UserProviderInterface
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }
    
    public function loadUserByUsername($username)
    {
        $managerRegistry = $this->managerRegistry;
        
        $em = $managerRegistry->getManager('manager_0');
        
        $user = $em->getRepository('CdoUserBundle:User')
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