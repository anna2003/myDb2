<?php

use App\Connection;
use App\QueryHelper;

$db = new QueryHelper(Connection::make($config));
$posts = $db->getAll("posts");

var_dump($posts);