<?php
    require_once './config.php';
    if('cli' === php_sapi_name()) {
        echo 'Starting reset...';
        MySQL::getInstance()->x('truncate `records`');
        echo ' done.';
    } else {
        Response::getInstance()->json([
            'error' => 'forbidden',
        ], 403);
    }
    
    exit;
