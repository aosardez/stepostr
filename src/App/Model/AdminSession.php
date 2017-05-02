<?php

namespace App\Model;

class AdminSession
{
	protected $accountId;
	protected $isAdmin;

	public function __construct(array $data) {
        $this->accountId = $data['accountId'] ?? 0;
        $this->isAdmin = $data['isAdmin'] ?? 0;
    }

    public function getAccountId() {
        return $this->accountId;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }
}