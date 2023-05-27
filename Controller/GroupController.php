<?php

require_once "model/GroupDB.php";

class GroupController {
    public static function index() {
        if (isset($_GET["id"])) {
            $groupId = $_GET["id"];
            $group = GroupDB::getGroup($groupId);
            $recipes = RecipeDB::getRecipesByGroup($groupId);

            ViewHelper::render("view/group-chat.php", [
                "group" => $group,
                "recipes" => $recipes
            ]);
        } else {
            ViewHelper::render("view/group-selection.php", [
                "groups" => GroupDB::getAllGroups()
            ]);
        }
    }

    public function createGroup($groupName, $description) {
        // Validate input if needed

        // Create a new group
        GroupDB::insertGroup($groupName, $description);

        // Redirect or display success message
    }

    public function getGroup($groupId) {
        // Get the group from the database
        $group = GroupDB::getGroup($groupId);

        // Display the group details or pass it to a view
    }

    public function updateGroup($groupId, $groupName, $description) {
        // Validate input if needed

        // Update the group
        GroupDB::updateGroup($groupId, $groupName, $description);

        // Redirect or display success message
    }

    public static function showGroupSelection() {
        // Retrieve the groups from the database or any other source
        $groups = GroupDB::getAllGroups();

        // Render the view and pass the groups data
        ViewHelper::render("view/group-selection.php", ["groups" => $groups]);
    }

    public function deleteGroup($groupId) {
        // Delete the group
        GroupDB::deleteGroup($groupId);

        // Redirect or display success message
    }

    public static function addRecipe() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get the form data
            $title = $_POST["title"];
            $description = $_POST["description"];
            $ingredients = $_POST["ingredients"];
            $instructions = $_POST["instructions"];
            $group_id = $_POST["group_id"];
            $user_id = 1; // Assuming a user ID, modify this based on your authentication system

            // Insert the recipe into the database
            RecipeDB::insertRecipe($title, $description, $ingredients, $instructions, $group_id, $user_id);

            // Redirect back to the group chat page
            header("Location: index.php?action=group-chat&id=" . $group_id);
            exit;
        }
    }

}
