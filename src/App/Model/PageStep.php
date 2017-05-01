<?php

namespace App\Model;

class PageStep
{
	protected $id;
    protected $pageId;
    protected $name;
    protected $body;
    protected $image;

	public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->pageId = $data['pageId'] ?? 0;
        $this->name = $data['name'] ?? null;
        $this->body = $data['body'] ?? null;
        $this->image = $data['image'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getPageId() {
        return $this->pageId;
    }

    public function setPageId($pageId) {
        $this->pageId = $pageId;
    }

    public function getName() {
        return $this->name;
    }

    public function getBody() {
        return $this->body;
    }

    public function getImage() {
        return $this->image;
    }
}