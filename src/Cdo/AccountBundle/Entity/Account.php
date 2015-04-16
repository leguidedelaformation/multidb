<?php

namespace Cdo\AccountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="cdo_account_account")
 * @ORM\Entity(repositoryClass="Cdo\AccountBundle\Entity\AccountRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"apm" = "Apm\AccountBundle\Entity\Account", "cdo" = "Cdo\AccountBundle\Entity\Account"})
 */
class Account
{
    use Traits\AccountTrait
    ;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getDiscr()
    {
        $discr = explode('\\', get_class($this));
    
        return end($discr);
    }
}
