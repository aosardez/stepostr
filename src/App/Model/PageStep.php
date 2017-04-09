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
        $this->id = $data['id'];
        $this->pageId = $data['pageId'];
        $this->name = $data['name'];
        $this->body = $data['body'];
        $this->image = $data['image'];
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