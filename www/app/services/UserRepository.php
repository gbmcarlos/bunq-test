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

    public function getUser($username) {

        $stmt = $this->pdo->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->bindParam('username', $username);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function checkUserExists($username) : bool {

        $result = $this->getUser($username);

        return !empty($result);

    }

    public function createNewUser($data) : bool {

        $now = (new \DateTime())->getTimestamp();

        $stmt = $this->pdo->prepare("INSERT INTO user(username, createdAt) VALUES (:username, :now)");
        if (!$stmt) {
            return $this->pdo->errorInfo();
        }
        $stmt->bindParam('username', $data['username']);
        $stmt->bindParam('now', $now);
        $stmt->execute();

        $result = $stmt->rowCount() == 1;

        return $result;

    }

    public function getUserChats($username) {

    }

}