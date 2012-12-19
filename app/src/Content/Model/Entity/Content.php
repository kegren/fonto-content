<?php
/**
 * Content entity
 */
namespace Content\Model\Entity;

use DateTime;

/**
 * @Entity;
 * @Table(name="content")
 */
class Content
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Content\Model\Entity\User")
     */
    protected $user;

    /**
     * @Column(type="string")
     */
    protected $type;

    /**
     * @Column(type="string")
     */
    protected $title;

    /**
     * @Column(type="string")
     */
    protected $slug;

    /**
     * @Column(type="text")
     */
    protected $data;

    /**
     * @Column(type="string")
     */
    protected $filter;

    /**
     * @Column(type="datetime")
     */
    protected $created;

    /**
     * @Column(type="datetime")
     */
    protected $updated;

    /**
     * @Column(type="datetime")
     */
    protected $deleted;

    /**
     * Sets multiple values
     *
     * @param array $data
     */
    public function populate($data = array())
    {
        $this->setType($data['type']);
        $this->setTitle($data['title']);
        $this->setSlug($data['slug']);
        $this->setData($data['data']);
        $this->setFilter($data['filter']);
        $this->setCreated();
        $this->setUpdated();
        $this->setDeleted();
    }

    public function setCreated()
    {
        $this->created = new DateTime("now");
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setDeleted()
    {
        $this->deleted = new DateTime("now");
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUpdated()
    {
        $this->updated = new DateTime("now");
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function getFilter()
    {
        return $this->filter;
    }
}