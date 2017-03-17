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

    public function getSourceById($id)
    {
        // $stmt = $this->db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");
        $qb = $this->db->createQueryBuilder();
        $qb->select('*')
            ->from('sources')
            ->where('id = :id')
            ->setParameter('id', $id);
        $row = $qb->execute();

        return $row->fetch();
    }

    public function save(SourceEntity $source)
    {
        $qb = $this->db->createQueryBuilder();

        if ($source->getId()) {
            $qb->update('sources')->where('id = ' . $source->getId());
        } else {
            $qb->insert('sources');
        }

        $qb->setValue('name', '?')
            ->setValue('source_link', '?')
            ->setValue('rss_feed_link', '?')
            ->setValue('is_active', '?')
            ->setParameter(0, $source->getName())
            ->setParameter(1, $source->getSourceLink())
            ->setParameter(2, $source->getRssFeedLink())
            ->setParameter(3, $source->isActive());


        $result = $qb->execute();

        if (! $result) {
            throw new Exception("Can not save SourceEntity");
        }

        return $result;
    }
}
