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
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->slug = $data['slug'];
        $this->introduction = $data['introduction'];
        $this->body = $data['body'];
        $this->steps = $data['steps'];
        $this->conclusion = $data['conclusion'];
        $this->categoryId = $data['categoryId'];
        $this->authorId = $data['authorId'];
        $this->updaterId = $data['updaterId'];
        $this->published = $data['published'];
        $this->dateCreated = $data['dateCreated'];
        $this->dateModified = $data['dateModified'];
    }

    public function getId() {
        return $this->id;
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