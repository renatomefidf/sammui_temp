<?php

namespace Renatomefi\FormBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Renatomefi\UserBundle\Document\User;
use Renatomefi\FormBundle\Document\User as NonUser;

/**
 * Class Protocol
 * @package Renatomefi\FormBundle\Document
 * @ODM\Document
 */
class Protocol
{
    /**
     * Setting up ODM Document
     */
    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->nonUser = new ArrayCollection();
    }

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\Date
     */
    protected $createdAt;

    /**
     * @ODM\Date
     */
    protected $firstSaveDate;

    /**
     * @ODM\Date
     */
    protected $lastSaveDate;

    /**
     * @ODM\ReferenceMany(targetDocument="Renatomefi\UserBundle\Document\User")
     * @var ArrayCollection
     */
    protected $user;

    /**
     * @ODM\EmbedMany(targetDocument="User")
     * @var ArrayCollection
     */
    protected $nonUser;

    /**
     * @ODM\ReferenceOne(targetDocument="Form")
     */
    protected $form;

    /**
     * Get id
     *
     * @return $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \MongoDate $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \MongoDate $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set firstSaveDate
     *
     * @param \MongoDate $firstSaveDate
     * @return self
     */
    public function setFirstSaveDate($firstSaveDate)
    {
        $this->firstSaveDate = $firstSaveDate;
        return $this;
    }

    /**
     * Get firstSaveDate
     *
     * @return \MongoDate $firstSaveDate
     */
    public function getFirstSaveDate()
    {
        return $this->firstSaveDate;
    }

    /**
     * Set lastSaveDate
     *
     * @param \MongoDate $lastSaveDate
     * @return self
     */
    public function setLastSaveDate($lastSaveDate)
    {
        $this->lastSaveDate = $lastSaveDate;
        return $this;
    }

    /**
     * Get lastSaveDate
     *
     * @return \MongoDate $lastSaveDate
     */
    public function getLastSaveDate()
    {
        return $this->lastSaveDate;
    }

    /**
     * Set form
     *
     * @param \Renatomefi\FormBundle\Document\Form $form
     * @return self
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * Get form
     *
     * @return \Renatomefi\FormBundle\Document\Form $form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Add user
     *
     * @param \Renatomefi\UserBundle\Document\User $user
     */
    public function addUser(User $user)
    {
        $this->user[] = $user;
    }

    /**
     * Remove user
     *
     * @param \Renatomefi\UserBundle\Document\User $user
     */
    public function removeUser(User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add nonUser
     *
     * @param \Renatomefi\FormBundle\Document\User $nonUser
     */
    public function addNonUser(NonUser $nonUser)
    {
        $this->nonUser[] = $nonUser;
    }

    /**
     * Remove nonUser
     *
     * @param \Renatomefi\FormBundle\Document\User $nonUser
     */
    public function removeNonUser(NonUser $nonUser)
    {
        $this->nonUser->removeElement($nonUser);
    }

    /**
     * Get nonUser
     *
     * @return \Doctrine\Common\Collections\Collection $nonUser
     */
    public function getNonUser()
    {
        return $this->nonUser;
    }
}
