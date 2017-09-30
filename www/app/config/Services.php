<?php

namespace App\config;

use App\controllers\ApiController;
use App\controllers\FrontController;
use App\services\ChatRepository;
use App\services\UserRepository;
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:10 PM
 */
class Services {

    public static function registerServices(Application &$app) {

        $app->register(new ServiceControllerServiceProvider());

        $app['UserRepository'] = function() use ($app) {
            return new UserRepository(
                $app['DB']
            );
        };

        $app['ChatRepository'] = function() use ($app) {
            return new ChatRepository(
                $app['DB']
            );
        };

        $app['FrontController'] = function() use ($app) {
            return new FrontController(
                $app['UserRepository'],
                $app['ChatRepository'],
                $app['twig']
            );
        };

        $app['ApiController'] = function() use ($app) {
            return new ApiController(
                $app['UserRepository'],
                $app['ChatRepository']
            );
        };

        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__.'/../resources/templates',
        ));

        $app->register(new AssetServiceProvider(array(
            'assets.version' => 'v1',
            'assets.base_path' => __DIR__.'/../resources/assets',
            'assets.named_packages' => array(
                'css' => array('version' => 'css1', 'base_path' => __DIR__.'/../resources/assets/css'),
                'js' => array('version' => 'js', 'base_path' => __DIR__.'/../resources/assets/js')
            ),
        )));

    }

}