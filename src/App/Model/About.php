<?php

namespace App\Model;

class About
{
	protected $body;
	protected $dateModified;

	public function __construct(array $data) {
        $this->body = $data['body'] ?? null;
        $this->dateModified = $data['dateModified'] ?? null;
    }

    public function getBody() {
        return $this->body;
    }

    public function getDateModified() {
        return $this->dateModified;
    }
}