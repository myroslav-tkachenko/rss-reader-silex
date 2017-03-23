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

    public function save($news)
    {
        $sql = "INSERT IGNORE INTO news (title, link, description, source, pub_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $news->getTitle(),
            $news->getLink(),
            $news->getDescription(),
            $news->getSource(),
            $news->getPubDate(),
        ]);
    }
}
