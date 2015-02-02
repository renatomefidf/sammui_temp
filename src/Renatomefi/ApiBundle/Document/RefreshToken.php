<?php

namespace Renatomefi\ApiBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use FOS\OAuthServerBundle\Document\RefreshToken as BaseRefreshToken;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\OAuthServerBundle\Model\ClientInterface;

/**
 * @ODM\Document
 */
class RefreshToken extends BaseRefreshToken
{
    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Client")
     */
    protected $client;

    /**
     * @ODM\ReferenceOne(targetDocument="Flyers\BackendBundle\Document\User")
     */
    protected $user;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param Renatomefi\ApiBundle\Document\Client $client
     * @return self
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get client
     *
     * @return Renatomefi\ApiBundle\Document\Client $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param Flyers\BackendBundle\Document\User $user
     * @return self
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Flyers\BackendBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }
}
