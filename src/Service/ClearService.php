<?php


namespace Efko\PurgeLog\Service;


class ClearService
{
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function clear($config)
    {
        $queryBuilder = $this->db->createQueryBuilder();

        $queryBuilder
            ->delete($config['tableName'])
            ->where($config['condition'])
            ->execute()
        ;
    }
}