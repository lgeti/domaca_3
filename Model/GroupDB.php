<?php

require_once "DBInit.php";

class GroupDB {

    public static function getGroup($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name FROM [group]
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $group = $statement->fetch();

        if ($group != null) {
            return $group;
        } else {
            throw new InvalidArgumentException("No group record with id $id");
        }
    }

    public static function insertGroup($name, $description) {
        $db = DBInit::getInstance();
    
        $statement = $db->prepare("INSERT INTO [group] (name, description)
            VALUES (:name, :description)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":description", $description);
        $statement->execute();

        return $db->lastInsertId();
    }

    public static function updateGroup($id, $name) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE [group] SET name = :name
            WHERE id = :id");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteGroup($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM [group] WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function getAllGroups() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, name, description FROM [group]");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function isGroupNameTaken($name) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT COUNT(*) FROM [group] WHERE name = :name");
        $statement->bindParam(":name", $name);
        $statement->execute();

        $count = $statement->fetchColumn();

        return $count > 0;
    }

}