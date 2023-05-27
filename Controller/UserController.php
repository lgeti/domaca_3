<?php

require_once "model/UserDB.php";

class UserController {

    public static function registerUser() {
        // Validate input data (e.g., check if username is unique, password requirements, etc.)
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            // Handle invalid input, display error message, redirect to registration page, etc.
            // ...
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Missing username or password"
            ]);
            return ;
        }

        // Check if the username is already taken
        if (UserDB::getUserByUsername($_POST["username"]) !== null) {
            // Handle username already exists, display error message, redirect to registration page, etc.
            // ...
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Username taken"
            ]);
            return ;
        }

        // Call the UserDB method to insert the user into the database
        UserDB::insertUser($_POST["username"], $_POST["password"]);
        
        // Optionally, you can perform additional actions after successful registration (e.g., redirect to login page, send email confirmation, etc.)
        // ...
        // Redirect to login page or display success message
        ViewHelper::redirect("login");
    }

    public static function showRegistrationForm() {
        ViewHelper::render("view/user-register.php");
    }

    
    public static function loginUser() {
        if (UserDB::validLoginAttempt($_POST["username"], $_POST["password"])) {
            // Successful login, perform necessary actions (e.g., set session, redirect to home page, etc.)
            // ...
            // Set session or token for authentication
            // ...
            // Redirect to home page or display success message
            ViewHelper::redirect(BASE_URL . "group/selection");
        } else {
            ViewHelper::render("view/user-login.php", [
                "errorMessage" => "Invalid username or password."
            ]);
        }
    }

    public static function showLoginForm() {
        ViewHelper::render("view/user-login.php");
     }

    public static function logoutUser() {
        // Perform necessary actions to log out the user (e.g., clear session, redirect to login page, etc.)
        // ...
        // Clear session or token for authentication
        // ...
        // Redirect to login page or display success message
        // ...
    }

    public function deleteUser($userId) {
        // Call the UserDB method to delete the user from the database
        UserDB::deleteUser($userId);

        // Optionally, you can perform additional actions after successful deletion (e.g., redirect to home page, display success message, etc.)
        // ...
        // Redirect to home page or display success message
        // ...
    }

    // Additional methods for user-related actions can be added here

}
