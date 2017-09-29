<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/27/17
 * Time: 5:07 AM
 */

require_once __DIR__.'/../vendor/autoload.php';

// Create app
$app = new Silex\Application();

// Set debug from env var
$app['debug'] = getenv('APP_DEBUG');

// Set up db connections and set schema
$db = new DB\SQLiteDatabase();
$db->connect(getenv('SQLITEDB_FILE'));
$schema = require_once(__DIR__.'/../db/schema.php');
$db->create($schema);

// Register db in the service container
$app['DB'] =  function() use ($db) {
    return $db->getPDO();
};

$app->get('/hello/{name}', function ($name) use ($app, $db) {
    return var_dump($db->getTableList());
});

$app->run();