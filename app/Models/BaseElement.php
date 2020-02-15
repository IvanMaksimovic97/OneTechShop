<?php

namespace App\Models;
use App\Config\DataBase;

class BaseElement {
    
    protected $db;
    protected static $dbase;

    public function __construct(DataBase $db){
        $this->db = $db;
        self::$dbase = $db;
    }
}