<?php

namespace App\Model;

class Category
{
	protected $id;
    protected $name;
    protected $slug;
    protected $description;
    protected $published;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $this->description = $data['description'];
        $this->published = $data['published'];
        $this->dateCreated = $data['dateCreated'];
        $this->dateModified = $data['dateModified'];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPublished() {
        return $this->published;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}