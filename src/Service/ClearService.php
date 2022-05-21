<?php


namespace Efko\PurgeLog\Service;


class ClearService
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function clear()
    {
        print_r($this->db->getParams());

        return 'очищено';
    }
}