<?php
    require_once './config.php';
    
    Response::getInstance()->json([
        'result' => [
            'routes' => [
                'scores' => [
                    'GET /scores' => [
                        'method' => 'GET',
                        'path' => '/scores',
                        'params' => [],
                    ],
                ],
                'score' => [
                    'POST /score' => [
                        'method' => 'POST',
                        'path' => '/score',
                        'params' => [
                            'name', 'val',
                        ],
                    ],
                    'GET /score' => [
                        'method' => 'GET',
                        'path' => '/scores',
                        'params' => [
                            'name',
                        ],
                    ],
                ],
                'events' => [
                    'GET /events' => [
                        'method' => 'GET',
                        'path' => '/events',
                        'params' => [],
                    ],
                ],
            ],
        ],
    ]);
    
    exit;
