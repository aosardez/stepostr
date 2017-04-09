<?php

namespace App\Model;

class PageLookup
{
	protected $id;
    protected $title;
    protected $introduction;
    protected $categoryName;
    protected $authorName;
    protected $updaterName;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->introduction = $data['introduction'];
        $this->categoryName = $data['categoryName'];
        $this->authorName = $data['authorName'];
        $this->updaterName = $data['updaterName'];
        $this->dateCreated = $data['dateCreated'];
        $this->dateModified = $data['dateModified'];
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getIntroduction() {
        return $this->introduction;
    }

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getAuthorName() {
        return $this->authorName;
    }

    public function getUpdaterName() {
        return $this->updaterName;
    }

    public function getDateCreated() {
        return $this->dateCreated;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}