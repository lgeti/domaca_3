<?php

require_once "DBInit.php";

class ChatDB {
    public static function insertMessage($chatId, $userId, $message) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO message (chat_id, user_id, content, created_at)
            VALUES (:chatId, :userId, :content, NOW())");
        $statement->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->bindParam(":content", $message);
        $statement->execute();
    }

    public static function getMessagesByChat($chatId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, chat_id, user_id, content, created_at 
            FROM message WHERE chat_id = :chatId");
        $statement->bindParam(":chatId", $chatId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getChatsByUser($userId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT chat.id, chat.name, chat.description
            FROM chat
            INNER JOIN chat_user ON chat.id = chat_user.chat_id
            WHERE chat_user.user_id = :userId");
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
