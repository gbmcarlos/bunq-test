<?php

namespace App\services;

/**
 * Created by PhpStorm.
 * User: gbmcarlos
 * Date: 9/28/17
 * Time: 11:04 PM
 */
class ChatRepository {

    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function createNewChat($user1Id, $user2Id) {

        $now = (new \DateTime())->getTimestamp();

        $stmt = $this->pdo->prepare("INSERT INTO chat(user1Id, user2Id, createdAt) VALUES (:user1Id, :user2Id, :now)");
        if (!$stmt) {
            return $this->pdo->errorInfo();
        }
        $stmt->bindParam('user1Id', $user1Id);
        $stmt->bindParam('user2Id', $user2Id);
        $stmt->bindParam('now', $now);
        $stmt->execute();

        $result = $stmt->rowCount() == 1;

        return $result;

    }

    public function getMessages($chatId) {

    }

    public function getMessagesSince($chatId, $lastMessageId) {

    }

    public function saveNewMessage($chatId, $text) {

    }

}