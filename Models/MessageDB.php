<?php

require_once "DBInit.php";

class MessageDB {
    public static function insertMessage($groupId, $userId, $message) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO message (group_id, user_id, content, created_at)
            VALUES (:groupId, :userId, :content, NOW())");
        $statement->bindParam(":groupId", $groupId, PDO::PARAM_INT);
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->bindParam(":content", $message);
        $statement->execute();
    }

    public static function getMessagesByGroup($groupId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, group_id, user_id, content, created_at 
            FROM message WHERE group_id = :groupId");
        $statement->bindParam(":groupId", $groupId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getMessagesByUser($userId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, group_id, user_id, content, created_at 
            FROM message WHERE user_id = :userId");
        $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
