<?php


namespace Efko\PurgeLog\Service;


class ClearService
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function clear($table)
    {
        $queryBuilder = $this->db->createQueryBuilder();

        $queryBuilder
            ->delete($table['name'])
            ->where($table['condition'])
            ->execute()
        ;
    }
}