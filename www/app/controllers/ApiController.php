<?php
/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:03 PM
 */

namespace App\controllers;

use App\services\ChatRepository;
use App\services\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController {

    protected $userRepo;

    protected $chatRepo;

    public function __construct(UserRepository $userRepository, ChatRepository $chatRepository) {
        $this->userRepo = $userRepository;
        $this->chatRepo = $chatRepository;
    }

    public function checkUserExists($username, Request $request) {

        try {

            $userExists = $this->userRepo->checkUserExists($username);

            return new JsonResponse($userExists);

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function createNewUser(Request $request) {

    }

    public function getUserChats($username, Request $request) {

    }

    public function getChatMessages($chatId, Request $request) {

    }

    public function getChatMessagesSince($chatId, $lastMessageId, Request $request) {

    }

}