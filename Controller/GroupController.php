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

    public static function createGroupForm() {
        ViewHelper::render("view/group-create.php");
    }

    public static function createGroup() {
        // Validate input if needed
        // Mandatory Fields
        if (empty($_POST["groupName"])) {
            ViewHelper::render("view/group-create.php", [
                "errorMessage" => "Missing group name."
            ]);
            return;
        }
        $groupName = $_POST["groupName"];

        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $groupName)) {
            ViewHelper::render("view/group-create.php", [
                "errorMessage" => "Invalid group name format. Only alphanumeric characters and spaces are allowed."
            ]);
            return;
        }

        if (GroupDB::isGroupNameTaken($groupName)) {
            ViewHelper::render("view/group-create.php", [
                "errorMessage" => "Group name is already taken. Please choose a different group name."
            ]);
            return;
        }

        if (strlen($groupName) > 255) {
            ViewHelper::render("view/group-create.php", [
                "errorMessage" => "Group name should not exceed 255 characters."
            ]);
            return;
        }

        if (!empty($_POST["description"])) {
            $description = $_POST["description"];
            if (!preg_match('/^[a-zA-Z0-9\s]+$/', $description)) {
                ViewHelper::render("view/group-create.php", [
                    "errorMessage" => "Invalid group description format. Only alphanumeric characters and spaces are allowed."
                ]);
                return;
            }

            if (strlen($description) > 255) {
                ViewHelper::render("view/group-create.php", [
                    "errorMessage" => "Description should not exceed 255 characters."
                ]);
                return;
           }
        }
        
        // Create a new group
        GroupDB::insertGroup($groupName, $description);

        // Redirect or display success message
        ViewHelper::redirect("selection");
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
