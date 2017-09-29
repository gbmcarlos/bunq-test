<?php

namespace App\services;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:04 PM
 */
class UserRepository {

    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function checkUserExists($username) : bool {

        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->bindParam('username', $username);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return !empty($result);

    }

    public function createNewUser($username) {

    }

    public function getUserChats($username) {

    }

}