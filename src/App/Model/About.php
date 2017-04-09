<?php

namespace App\Model;

class About
{
	protected $body;
	protected $dateModified;

	public function __construct(array $data) {
        $this->body = $data['body'];
        $this->dateModified = $data['dateModified'];
    }

    public function getBody() {
        return $this->body;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}