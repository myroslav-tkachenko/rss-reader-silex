<?php

namespace App\Model;

class SourceEntity
{
    protected $id;
    protected $name;
    protected $source_link;
    protected $rss_feed_link;
    protected $is_active;

    public function __construct(array $data)
    {
        // no id if we're creating
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        $this->name = $data['name'];
        $this->source_link = $data['source_link'];
        $this->rss_feed_link = $data['rss_feed_link'];
        $this->is_active = $data['is_active'] ? true : false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSourceLink()
    {
        return $this->source_link;
    }

    public function getRssFeedLink()
    {
        return $this->rss_feed_link;
    }

    public function isActive()
    {
        return $this->is_active;
    }

}
