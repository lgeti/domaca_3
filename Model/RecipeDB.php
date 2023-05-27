<?php

require_once "DBInit.php";

class RecipeDB {

    public static function getRecipe($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, title, description, ingredients, instructions, group_id, user_id FROM recipe 
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch();

        if ($recipe != null) {
            return $recipe;
        } else {
            throw new InvalidArgumentException("No recipe record with id $id");
        }
    }

    public static function insertRecipe($title, $description, $ingredients, $instructions, $group_id, $user_id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO recipe (title, description, ingredients, instructions, group_id, user_id)
            VALUES (:title, :description, :ingredients, :instructions, :group_id, :user_id)");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":ingredients", $ingredients);
        $statement->bindParam(":instructions", $instructions);
        $statement->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function updateRecipe($id, $title, $description, $ingredients, $instructions, $group_id, $user_id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE recipe SET title = :title,
            description = :description, ingredients = :ingredients, instructions = :instructions,
            group_id = :group_id, user_id = :user_id WHERE id = :id");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":ingredients", $ingredients);
        $statement->bindParam(":instructions", $instructions);
        $statement->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function deleteRecipe($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM recipe WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }
    
    public static function getRecipesByGroup($groupId) {
        $db = DBInit::getInstance();
    
        $statement = $db->prepare("SELECT id, title, description, ingredients, instructions, group_id, user_id
            FROM recipe
            WHERE group_id = :group_id");
        $statement->bindParam(":group_id", $groupId, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
