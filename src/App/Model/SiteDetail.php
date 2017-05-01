<?php

namespace App\Model;

class SiteDetail
{
	protected $title;
	protected $tagline;
	protected $dateModified;

	public function __construct(array $data) {
        $this->title = $data['title'] ?? null;
        $this->tagline = $data['tagline'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getTagline() {
        return $this->tagline;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}