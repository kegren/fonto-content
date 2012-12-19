<?php

namespace Content\Model\Entity;

/**
 * @Entity;
 * @Table(name="userroles")
 */
class UserRole
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="integer", name="user_id")
     */
    protected $userId;

    /**
     * @Column(type="integer", name="role_id")
     */
    protected $roleId;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}