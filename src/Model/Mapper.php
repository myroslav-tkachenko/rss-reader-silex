<?php

namespace App\Model;

abstract class Mapper
{
    protected $db;

    public function __construct(\Doctrine\DBAL\Connection $db)
    {
        $this->db = $db;
    }
}