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
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->published = $data['published'] ?? 0;
        $this->dateCreated = $data['dateCreated'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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