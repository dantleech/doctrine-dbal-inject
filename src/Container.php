<?php

namespace Exploit;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class Container
{
    public function dbal(): Connection {
        $connectionParams = array(
            'url' => 'mysql://user:password@localhost/exploit',
        );
        return DriverManager::getConnection($connectionParams);
    }

    public function postRepository(): PostRepository {
        return new PostRepository($this->dbal());
    }

    public function postController(): PostController {
        return new PostController(
            $this->postRepository()
        );
    }
}
