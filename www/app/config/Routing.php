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

        // front pages
        $app->get('/login', "FrontController:loginAction")
            ->bind('login_page');
        $app->get('/{username}/dashboard', "FrontController:dashboardAction")
            ->bind('dashboard_page');
        $app->get('/{username}/chat/{chatId}', "FrontController:chatAction")
            ->bind('chat_page');

        // api endpoints
        // user
        $app->get('/check_user_exists/{username}', "ApiController:checkUserExists")
            ->bind('checkUserExists');
        $app->post('/create_new_user', "ApiController:createNewUser")
            ->bind('createNewUser');
        $app->get('/get_user_chats/{username}', "ApiController:getUserChats")
            ->bind('getUserChats');

        // chat
        $app->get('/get_chat_messages/{chatId}', "ApiController:getChatMessages")
            ->bind('getChatMessages');
        $app->get('/get_chat_messages_since/{chatId}/{lastMessageId}', "ApiController:getChatMessagesSince")
            ->bind('getChatMessagesSince');

    }

}