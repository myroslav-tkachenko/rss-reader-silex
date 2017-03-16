<?php

namespace App\Model;

use App\Model\Mapper;

class NewsMapper extends Mapper
{
    public function getNews()
    {
        $stmt = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");
        $items = $stmt->fetchAll();

        var_dump($items);
        echo 'Getting News';
    }
}