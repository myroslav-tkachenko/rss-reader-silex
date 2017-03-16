<?php

namespace App\Model;

use App\Model\Mapper;
use App\Model\NewsEntity;

class NewsMapper extends Mapper
{
    public function getNews()
    {
        $stmt = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");

        $results = [];
        while ($row = $stmt->fetch()) {
            $results = new NewsEntity($row);
        }
        
        return $results;
    }
}
