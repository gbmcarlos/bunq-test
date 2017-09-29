<?php

namespace App\controllers;

use Symfony\Component\HttpFoundation\Request;
use App\services\ChatRepository;
use App\services\UserRepository;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 10:59 PM
 */
class FrontController {

    protected $userRepo;

    protected $chatRepo;

    public function __construct(UserRepository $userRepository, ChatRepository $chatRepository) {
        $this->userRepo = $userRepository;
        $this->chatRepo = $chatRepository;
    }

    public function loginAction(Request $request) {
        return 'Hello login';
    }

    public function dashboardAction($username, Request $request) {
        return 'Hello dashboard, username: ' . $username;
    }

    public function chatAction($username, $chatId, Request $request) {
        return 'Hello chat, username: ' . $username . ', chatId: ' . $chatId;
    }

}