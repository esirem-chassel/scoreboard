<?php
require_once '../config.php';

if(Request::getInstance()->is(Request::METHOD_GET)) {
    $w = Request::getInstance()->getData('when', 'current');
    $current = trim(file_get_contents(__DIR__.'/.'.$w));
    Response::getInstance()->json([
        'result' => $current,
    ]);
} else {
    Response::getInstance()->json([], 405);
}

exit;
