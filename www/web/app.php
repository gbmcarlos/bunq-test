<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/27/17
 * Time: 5:07 AM
 */

require_once __DIR__.'/../vendor/autoload.php';

$db = new DB\SQLiteDatabase();
$db->connect(getenv('SQLITEDB_FILE'));
$schema = require_once(__DIR__.'/../db/schema.php');
$db->create($schema);

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app, $db) {
    return var_dump($db->getTableList());
});

$app->run();