<?php

namespace App\ModelMapper;

abstract class BaseMapper
{
    protected $db;

	public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
}