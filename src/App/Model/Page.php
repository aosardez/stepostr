<?php

namespace App\Model;

class Page
{
	protected $id;
    protected $title;
    protected $slug;
    protected $showIntroductionLabel;
    protected $introductionLabel;
    protected $introduction;
    protected $showBodyLabel;
    protected $bodyLabel;
    protected $body;
    protected $showStepLabel;
    protected $stepLabel;
    protected $showStepNumber;
    protected $steps;
    protected $showConclusionLabel;
    protected $conclusionLabel;
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
        $this->showIntroductionLabel = $data['showIntroductionLabel'] ?? 0;
        $this->introductionLabel = $data['introductionLabel'] ?? null;
        $this->introduction = $data['introduction'] ?? null;
        $this->showBodyLabel = $data['showBodyLabel'] ?? 0;
        $this->bodyLabel = $data['bodyLabel'] ?? null;
        $this->body = $data['body'] ?? null;
        $this->showStepLabel = $data['showStepLabel'] ?? 0;
        $this->stepLabel = $data['stepLabel'] ?? null;
        $this->showStepNumber = $data['showStepNumber'] ?? 0;
        $this->steps = $data['steps'] ?? null;
        $this->showConclusionLabel = $data['showConclusionLabel'] ?? 0;
        $this->conclusionLabel = $data['conclusionLabel'] ?? null;
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

    public function getShowIntroductionLabel() {
        return $this->showIntroductionLabel;
    }

    public function getIntroductionLabel() {
        return $this->introductionLabel;
    }

    public function getIntroduction() {
        return $this->introduction;
    }

    public function getShowBodyLabel() {
        return $this->showBodyLabel;
    }

    public function getBodyLabel() {
        return $this->bodyLabel;
    }

    public function getBody() {
        return $this->body;
    }

    public function getShowStepLabel() {
        return $this->showStepLabel;
    }

    public function getStepLabel() {
        return $this->stepLabel;
    }

    public function getShowStepNumber() {
        return $this->showStepNumber;
    }

    public function getSteps() {
        return $this->steps;
    }

    public function getShowConclusionLabel() {
        return $this->showConclusionLabel;
    }

    public function getConclusionLabel() {
        return $this->conclusionLabel;
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