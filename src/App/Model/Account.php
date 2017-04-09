<?php

namespace App\Model;

class Account
{
	protected $id;
    protected $username;
    protected $password;
    protected $displayName;
    protected $active;
    protected $lastLoginDate;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->displayName = $data['displayName'];
        $this->active = $data['active'];
        $this->lastLoginDate = $data['lastLoginDate'];
        $this->dateCreated = $data['dateCreated'];
        $this->dateModified = $data['dateModified'];
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getActive() {
        return $this->active;
    }

    public function getLastLoginDate() {
        return $this->lastLoginDate;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}