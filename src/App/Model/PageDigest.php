<?php

namespace App\Model;

class PageDigest
{
	protected $id;
    protected $title;
    protected $slug;
    protected $introduction;
    protected $categoryName;
    protected $categorySlug;
    protected $published;
    protected $authorName;
    protected $updaterName;
    protected $dateCreated;
    protected $dateModified;

	public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->title = $data['title'] ?? null;
        $this->slug = $data['slug'] ?? null;
        $this->introduction = $data['introduction'] ?? null;
        $this->categoryName = $data['categoryName'] ?? null;
        $this->categorySlug = $data['categorySlug'] ?? null;
        $this->published = $data['published'] ?? 0;
        $this->authorName = $data['authorName'] ?? null;
        $this->updaterName = $data['updaterName'] ?? null;
        $this->dateCreated = $data['dateCreated'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
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

    public function getCategoryName() {
        return $this->categoryName;
    }

    public function getCategorySlug() {
        return $this->categorySlug;
    }

    public function getPublished() {
        return $this->published;
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