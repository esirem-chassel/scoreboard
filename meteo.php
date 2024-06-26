<?php
    // use it in crontab or on special event !
    require_once './config.php';
    
    $meteos = [
        'freeze',
        'rain',
        'ok',
        'sun',
        'heat'
    ];
    
    $fn = __DIR__.'/events/.current'; // maybe a .previous and .next for trends ?
    $oldMeteo = trim(file_get_contents($fn));
    $meteo = $meteos[array_rand($meteos)];
    // we allow the change only if that goes from one to a next/previous one
    if(1 == abs(array_search($meteo, $meteos) - array_search($oldMeteo, $meteos))) {
        $fh = fopen($fn, 'w+'); // truncate
        fwrite($fh, $meteo);
        fclose($fh);
    }
    
    Response::getInstance()->json([
        'result' => $meteo,
    ]);
    
    exit;
