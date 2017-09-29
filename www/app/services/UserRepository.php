<?php

namespace App\services;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:04 PM
 */
class UserRepository {

    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function checkUserExists($username) {

    }

    public function createNewUser($username) {

    }

    public function getUserChats($username) {

    }

}