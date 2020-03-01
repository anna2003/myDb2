<?php

namespace App\controllers;

use App\models\QueryHelper;

class PostController
{
    public  $db;
    public function __construct(QueryHelper $db)
    {
        $this->db = $db;
    }

    public function index(){
        $posts = $this->db->getAll("posts");
        var_dump($posts);
    }

    public function about(){
        echo "!!!!!!!!!!!!!!!!!";
    }
}