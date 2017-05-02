<?php

namespace App\Model;

class NavSession
{
	protected $pageTitle;
	protected $section;
    protected $subSection;

	public function __construct(array $data) {
        $this->pageTitle = $data['pageTitle'] ?? null;
        $this->section = $data['section'] ?? null;
        $this->subSection = $data['subSection'] ?? null;
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    public function getSection() {
        return $this->section;
    }

    public function getSubSection() {
        return $this->subSection;
    }
}