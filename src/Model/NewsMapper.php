<?php

namespace App\Model;

use App\Model\Mapper;
use App\Model\NewsEntity;

class NewsMapper extends Mapper
{
    public function getNews()
    {
        // $stmt = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')->from('news')->orderBy('id', 'desc')->setMaxResults(50);
        $rows = $qb->execute();

        $results = [];
        while ($row = $rows->fetch()) {
            $results[] = new NewsEntity($row);
        }

        return $results;
    }
}
