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
use Symfony\Component\Routing\Generator\UrlGenerator;

class ApiController {

    protected $userRepo;
    protected $chatRepo;
    protected $urlGenerator;

    public function __construct(UserRepository $userRepository, ChatRepository $chatRepository, UrlGenerator $urlGenerator) {
        $this->userRepo = $userRepository;
        $this->chatRepo = $chatRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function login($username, Request $request) {

        $validUsername = $this->validateUsername($username);

        if ($validUsername) {

            $userExists = $this->userRepo->checkUserExists($username);

            if (!$userExists) {
                $this->userRepo->createNewUser(array(
                    'username' => $username
                ));
            }

            return new JsonResponse(array(
                'success' => true,
                'data' => array(
                    'redirectUrl' => $this->urlGenerator->generate('dashboard_page', array('username' => $username))
                )
            ));

        } else {
            return new JsonResponse(array(
                'success' => false,
                'error' => "Invalid username '$username'"
            ));
        }

    }

    protected function validateUsername($username) : bool {

        return !empty($username);

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