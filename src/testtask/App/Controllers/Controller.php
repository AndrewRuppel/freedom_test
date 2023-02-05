<?php

namespace App\Controllers;

use App\Database;

abstract class Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}