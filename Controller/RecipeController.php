<?php

require_once "model/RecipeDB.php";

class RecipeController {
    public static function createRecipe($title, $description, $ingredients, $instructions, $groupId, $userId) {
        // Validate input if needed

        // Create a new recipe
        RecipeDB::insertRecipe($title, $description, $ingredients, $instructions, $groupId, $userId);

        // Redirect or display success message
        header("Location: index.php?action=group-chat&id=" . $groupId); //MIGHT BE A PROBLEM
    }

    public static function getRecipe($recipeId) {
        // Get the recipe from the database
        $recipe = RecipeDB::getRecipe($recipeId);

        // Display the recipe details or pass it to a view
    }

    public static function updateRecipe($recipeId, $title, $description, $ingredients, $instructions, $groupId, $userId) {
        // Validate input if needed

        // Update the recipe
        RecipeDB::updateRecipe($recipeId, $title, $description, $ingredients, $instructions, $groupId, $userId);

        // Redirect or display success message
    }

    public static function deleteRecipe($recipeId) {
        // Delete the recipe
        RecipeDB::deleteRecipe($recipeId);

        // Redirect or display success message
    }
}
