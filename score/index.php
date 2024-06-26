<?php
require_once '../config.php';

if(Request::getInstance()->is(Request::METHOD_POST)) {
    if(Request::getInstance()->hasData('val')
            && Request::getInstance()->hasData('name')) {
        if(MySQL::getInstance()->x('insert into `records` (`name`, `val`) values(:n, :v) on duplicate key update `val`=max(`val`, :v)', [
            'n' => Request::getInstance()->getData('name'),
            'v' => Request::getInstance()->getData('val'),
        ], false)) {
            Response::getInstance()->json([
                'result' => 'ok',
            ]);
        } else {
            Response::getInstance()->json([
                'result' => 'not modified',
            ], 204);
        }
    } else {
        Response::getInstance()->json([
            'error' => 'Missing name, val arguments',
        ], 400);
    }
} elseif(Request::getInstance()->is(Request::METHOD_GET)) {
    if(Request::getInstance()->hasData('name')) {
        var_dump('select * from `records` where `name` like "%'.Request::getInstance()->getData('name').'%"');
        $found = MySQL::getInstance()->o('select * from `records` where `name` like "%'.Request::getInstance()->getData('name').'%"');
        if($found) {
            Response::getInstance()->json([
                'result' => $found['val'],
            ]);
        } else {
            Response::getInstance()->json([
                'error' => 'Not found',
            ], 404);
        }
    } else {
        Response::getInstance()->json([
            'error' => 'Missing name argument',
        ], 400);
    }
} else {
    Response::getInstance()->json([], 405);
}

exit;
