<?php

namespace App\Model;

use App\Model\Mapper;
use App\Model\SourceEntity;

class SourceMapper extends Mapper
{
    public function getSources()
    {
        // $stmt = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')->from('sources');
        $rows = $qb->execute();

        $results = [];
        while ($row = $rows->fetch()) {
            $results[] = new SourceEntity($row);
        }

        return $results;
    }
}
