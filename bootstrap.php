<?php

define('BASE_PATH', __DIR__);

require BASE_PATH . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter;
use Dotenv\Repository\RepositoryBuilder;

$repository = RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

Dotenv::create($repository, [BASE_PATH])->safeLoad();
