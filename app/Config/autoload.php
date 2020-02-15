<?php

// AUTOLOAD
spl_autoload_register(function($putanja){
    // App\Config\DB
    // app/Config/DB.php
    // app\Config\DB.php
    $putanja = str_replace("\\", "/", $putanja);
    $putanja[0] = strtolower($putanja[0]);
     //echo $putanja;
    $putanja .= ".php";
    require_once $putanja;
});