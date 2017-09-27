<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/27/17
 * Time: 5:07 AM
 */

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->run();