<?php
require_once '../config.php';

if(Request::getInstance()->is(Request::METHOD_GET)) {
    $records = MySQL::getInstance()->l('select * from `records`');
    Response::getInstance()->json([
        'result' => $records,
    ]);
} else {
    Response::getInstance()->json([], 405);
}

exit;
