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

class ApiController {

    protected $userRepo;

    protected $chatRepo;

    public function __construct(UserRepository $userRepository, ChatRepository $chatRepository) {
        $this->userRepo = $userRepository;
        $this->chatRepo = $chatRepository;
    }

}