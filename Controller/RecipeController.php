<?php

require_once "model/RecipeDB.php";
require_once("ViewHelper.php");

class RecipeController {
    public static function createRecipe($title, $description, $ingredients, $instructions, $groupId, $userId) {
        // Create a new recipe
        RecipeDB::insertRecipe($title, $description, $ingredients, $instructions, $groupId, $userId);

        // Redirect or display success message
        ViewHelper::redirect(BASE_URL . "group?id=" . $groupId);
    }

    public static function getRecipe($recipeId) {
        // Get the recipe from the database
        $recipe = RecipeDB::getRecipe($recipeId);
    }

    public static function deleteRecipe($recipeId) {
        // Delete the recipe
        RecipeDB::deleteRecipe($recipeId);

    }
}
