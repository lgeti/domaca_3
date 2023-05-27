<?php

require_once "model/RecipeDB.php";

class RecipeController {
    public function createRecipe($title, $description, $ingredients, $instructions, $groupId, $userId) {
        // Validate input if needed

        // Create a new recipe
        RecipeDB::insertRecipe($title, $description, $ingredients, $instructions, $groupId, $userId);

        // Redirect or display success message
    }

    public function getRecipe($recipeId) {
        // Get the recipe from the database
        $recipe = RecipeDB::getRecipe($recipeId);

        // Display the recipe details or pass it to a view
    }

    public function updateRecipe($recipeId, $title, $description, $ingredients, $instructions, $groupId, $userId) {
        // Validate input if needed

        // Update the recipe
        RecipeDB::updateRecipe($recipeId, $title, $description, $ingredients, $instructions, $groupId, $userId);

        // Redirect or display success message
    }

    public function deleteRecipe($recipeId) {
        // Delete the recipe
        RecipeDB::deleteRecipe($recipeId);

        // Redirect or display success message
    }
}
