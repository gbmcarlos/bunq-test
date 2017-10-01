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
        $app->get('/{username1}/chat/{username2}', "FrontController:chatAction")
            ->bind('chat_page');

        // api endpoints
        // user
        $app->post('/api/login/{username}', "ApiController:login")
            ->bind('login');
        $app->get('/api/get_user_chats/{username}', "ApiController:getUserChats")
            ->bind('getUserChats');

        // chat
        $app->get('/check_chat_exists/{username1}/{username2}', "ApiController:checkChatExists")
            ->bind('checkChatExists');

        $app->post('/{username1}/create_new_chat/{username2}', "ApiController:createNewChat")
            ->bind('createNewChat');

        $app->post('/{username1}/create_new_message/{username2}', "ApiController:createNewMessage")
            ->bind('createNewMessage');

        $app->get('/{username1}/get_chat_messages/{username2}', "ApiController:getChatMessages")
            ->bind('getChatMessages');

        $app->get('/get_chat_messages_since/{chatId}/{lastMessageId}', "ApiController:getChatMessagesSince")
            ->bind('getChatMessagesSince');

    }

}