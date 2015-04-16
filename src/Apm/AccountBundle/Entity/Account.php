<?php

namespace Apm\AccountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cdo\AccountBundle\Entity\Account as BaseAccount;

/**
 * Account
 *
 * @ORM\Entity(repositoryClass="Apm\AccountBundle\Entity\AccountRepository")
 */
class Account extends BaseAccount
{
    /**
     * @var string
     *
     * @ORM\Column(name="subdomain", type="string", length=255)
     */
    private $subdomain;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="connection", type="integer")
     */
    private $connection;


    /**
     * Set subdomain
     *
     * @param string $subdomain
     * @return Account
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;

        return $this;
    }

    /**
     * Get subdomain
     *
     * @return string 
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * Set connection
     *
     * @param integer $connection
     * @return Account
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get connection
     *
     * @return integer 
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Set discr
     *
     * @param string $discr
     * @return Account
     */
    public function setDiscr($discr)
    {
        $this->discr = $discr;
    
        return $this;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDiscr('apm');
    }
}
