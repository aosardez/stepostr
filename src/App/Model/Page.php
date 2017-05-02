<?php

namespace App\Model;

class Page
{
	protected $id;
    protected $title;
    protected $slug;
    protected $introduction;
    protected $body;
    protected $steps;
    protected $conclusion;
    protected $categoryId;
    protected $authorId;
    protected $updaterId;
    protected $published;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->title = $data['title'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->introduction = $data['introduction'] ?? null;
        $this->body = $data['body'] ?? null;
        $this->steps = $data['steps'] ?? null;
        $this->conclusion = $data['conclusion'] ?? null;
        $this->categoryId = $data['categoryId'] ?? 0;
        $this->authorId = $data['authorId'] ?? 0;
        $this->updaterId = $data['updaterId'] ?? 0;
        $this->published = $data['published'] ?? null;
        $this->dateCreated = $data['dateCreated'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getIntroduction() {
        return $this->introduction;
    }

    public function getBody() {
        return $this->body;
    }

    public function getSteps() {
        return $this->steps;
    }

    public function getConclusion() {
        return $this->conclusion;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function getUpdaterId() {
        return $this->updaterId;
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