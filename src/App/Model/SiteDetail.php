<?php

namespace App\Model;

class SiteDetail
{
	protected $title;
	protected $tagline;
	protected $dateModified;

	public function __construct(array $data) {
        $this->title = $data['title'];
        $this->tagline = $data['tagline'];
        $this->dateModified = $data['dateModified'];
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