<?php

namespace Exploit;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use PDO;

final class PostRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function showLines($start, $end): array
    {
        $builder = new QueryBuilder($this->connection);

        $builder->select('*');
        $builder->from('post');

        $builder->setMaxResults($end);
        $builder->setFirstResult($start);

        $result = $builder->execute();

        return $result->fetchAllAssociative();
    }
}
