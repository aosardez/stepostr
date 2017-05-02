<?php

namespace App\Model;

class Account
{
	protected $id;
    protected $username;
    protected $password;
    protected $displayName;
    protected $active;
    protected $admin;
    protected $lastLoginDate;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->displayName = $data['displayName'] ?? null;
        $this->active = $data['active'] ?? 0;
        $this->admin = $data['admin'] ?? 0;
        $this->lastLoginDate = $data['lastLoginDate'] ?? null;
        $this->dateCreated = $data['dateCreated'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getAdmin() {
        return $this->admin;
    }

    public function getLastLoginDate() {
        return $this->lastLoginDate;
    }

    public function setLastLoginDate($lastLoginDate) {
        $this->lastLoginDate = $lastLoginDate;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}