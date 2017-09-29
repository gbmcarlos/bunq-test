<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/29/17
 * Time: 4:27 AM
 */

namespace App\config;

use Silex\Application;

class Routing {

    public static function registerRoutes(Application $app) {

        $app->get('/login', "FrontController:loginAction");
        $app->get('/{username}/dashboard', "FrontController:dashboardAction");
        $app->get('/{username}/chat/{chatId}', "FrontController:chatAction");

    }

}