<?php

require_once "DBInit.php";

class UserDB {

    public static function getUser($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, username, password FROM user 
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $user = $statement->fetch();

        if ($user != null) {
            return $user;
        } else {
            throw new InvalidArgumentException("No user record with id $id");
        }
    }

    public static function insertUser($username, $password) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO user (username, password)
            VALUES (:username, :password)");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->execute();
    }

    public static function updateUser($id, $username, $password) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE user SET username = :username,
            password = :password WHERE id = :id");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteUser($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM user WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function getUserByUsername($username) {
        $db = DBInit::getInstance();
    
        $statement = $db->prepare("SELECT id, username, password FROM user 
            WHERE username = :username");
        $statement->bindParam(":username", $username);
        $statement->execute();
    
        $user = $statement->fetch();
    
        if ($user != null) {
            return $user;
        } else {
            return null; // Return null if no user record is found
        }
    }
}
