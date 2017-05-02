<?php

namespace App\Model;

class PageStep
{
	protected $id;
    protected $pageId;
    protected $name;
    protected $order;
    protected $body;
    protected $imagePath;

	public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->pageId = $data['pageId'] ?? 0;
        $this->name = $data['name'] ?? null;
        $this->order = $data['order'] ?? 0;
        $this->body = $data['body'] ?? null;
        $this->imagePath = $data['imagePath'] ?? null;
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

    public function getOrder() {
        return $this->order;
    }

    public function getBody() {
        return $this->body;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }
}