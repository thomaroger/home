<?php

if(file_exists(stream_resolve_include_path('env.php'))){
    require_once('env.php');
}


if(getenv('ENV') != "dev") {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if (!in_array($ip, array("176.135.36.146","91.166.187.35", "176.153.4.179", '81.18.187.162'))) {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
}


$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == "/trash") {    
    require_once('Trash.class.php');
    $trash = new Trash();
    header('Content-Type: text/html; charset=utf-8');
    echo $trash->getTrash();
    exit;
}

if ($requestUri == "/weather") {    
    require_once("Meteo.class.php");
    $meteo = new Meteo();
    header('Content-Type: text/html; charset=utf-8');
    echo $meteo->render();
    exit;
}

if ($requestUri == "/netatmo") {   
    require_once ('netatmo-api-php/src/Netatmo/autoload.php');

    require_once('Netatmo.class.php');
    $netatmo = new Netatmo();
    header('Content-Type: text/html; charset=utf-8');
    echo $netatmo->render();
    exit;
}

if ($requestUri == "/flipr") {    
    require_once('Flipr.class.php');
    $flipr = new Flipr(getenv('FLIPR_USER'), getenv('FLIPR_PWD'));
    header('Content-Type: text/html; charset=utf-8');
    echo $flipr->render();
    exit;
}

if ($requestUri == "/volet") {    
    require_once('Volet.class.php');
    $volet = new Volet();
    header('Content-Type: text/html; charset=utf-8');
    echo $volet->render();
    exit;
}

if ($requestUri == "/light") {    
    require_once('Light.class.php');
    $light = new Light();
    header('Content-Type: text/html; charset=utf-8');
    echo $light->render();
    exit;
}

if ($requestUri == "/radiator") {    
    require_once('Radiator.class.php');
    $radiator = new Radiator();
    header('Content-Type: text/html; charset=utf-8');
    echo $radiator->render();
    exit;
}


if ($requestUri == "/weather-days") {    
    require_once('Weather.class.php');
    $weather = new Weather();
    header('Content-Type: text/html; charset=utf-8');
    echo  $weather->render();
    exit;
}


if ($requestUri == "/gmap") {    
    require_once('Gmap.class.php');
    $gmap = new Gmap();
    header('Content-Type: text/html; charset=utf-8');
    echo $gmap->render();
    exit;
}
