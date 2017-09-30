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

        try {

            $result = $this->userRepo->createNewUser($request->request->all());

            return new JsonResponse($result);

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function checkChatExists($username1, $username2, Request $request) {

        try {

            $user1 = $this->userRepo->getUser($username1);
            $user2 = $this->userRepo->getUser($username2);

            if ($user1 && $user2) {

                $result = $this->chatRepo->checkChatExists($user1['id'], $user2['id']);

                return new JsonResponse($result);

            } else {
                return new JsonResponse(false);
            }


        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function createNewChat($username1, $username2, Request $request) {

        try {

            $user1 = $this->userRepo->getUser($username1);
            $user2 = $this->userRepo->getUser($username2);

            $chatExists = $this->chatRepo->checkChatExists($username1, $username2);

            if ($user1 && $user2 && !$chatExists) {

                $result = $this->chatRepo->createNewChat($user1['id'], $user2['id']);

                return new JsonResponse($result);

            } else {
                return new JsonResponse(false);
            }

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function getUserChats($username, Request $request) {

        try {

            $user = $this->userRepo->getUser($username);

            if ($user) {

                $userChats = $this->userRepo->getUserChats($user['id']);

                return new JsonResponse($userChats);

            } else {

                return new JsonResponse([]);

            }

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function createNewMessage($username1, $username2, Request $request) {

        try {

            $user1 = $this->userRepo->getUser($username1);
            $user2 = $this->userRepo->getUser($username2);

            $chat = $this->chatRepo->getChatByUserIds($user1['id'], $user2['id']);

            if ($chat) {

                $result = $this->chatRepo->createNewMessage($chat['id'], $user1['id'], $request->request->get('text'));

                return new JsonResponse($result);
            }

            return new JsonResponse(false);

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function getChatMessages($username1, $username2, Request $request) {

        try {

            $user1 = $this->userRepo->getUser($username1);
            $user2 = $this->userRepo->getUser($username2);

            $chat = $this->chatRepo->getChatByUserIds($user1['id'], $user2['id']);

            if ($chat) {

                $result = $this->chatRepo->getChatMessages($chat['id']);

                foreach ($result as $index => $message) {

                    $result[$index]['sent'] = $message['senderId'] == $user1['id'];

                }

                return new JsonResponse($result);
            }

            return new JsonResponse(false);

        } catch (\Exception $e) {
            return new JsonResponse(false);
        }

    }

    public function getChatMessagesSince($chatId, $lastMessageId, Request $request) {

    }

}