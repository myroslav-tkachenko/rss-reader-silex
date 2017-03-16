<?php

namespace App\Model;

abstract class Mapper
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
}