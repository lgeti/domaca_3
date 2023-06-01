<?php


require_once "model/UserDB.php";

class UserController {

    public static function registerUser() {
        // Validate input data (e.g., check if username is unique, password requirements, etc.)
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Missing username or password"
            ]);
            return ;
        }

        // Validate username format (alphanumeric characters only)
        if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST["username"])) {
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Invalid username format. Only alphanumeric characters are allowed."
            ]);
            return;
        }

        // Check if the username is already taken
        if (UserDB::getUserByUsername($_POST["username"]) !== null) {
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Username taken"
            ]);
            return ;
        }

        // Validate password length (minimum 8 characters)
        if (strlen($_POST["password"]) < 8) {
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Password must be at least 8 characters long"
            ]);
            return;
        }

        // Check if password and confirm_password match
        if ($_POST["password"] !== $_POST["confirm_password"]) {
            ViewHelper::render("view/user-register.php", [
                "errorMessage" => "Password and confirm password do not match"
            ]);
            return;
        }

        // Call the UserDB method to insert the user into the database
        UserDB::insertUser($_POST["username"], $_POST["password"]);
        
        // Redirect to login page or display success message
        ViewHelper::redirect("login");
    }

    public static function showRegistrationForm() {
        ViewHelper::render("view/user-register.php");
    }

    
    public static function loginUser() {
        if (UserDB::validLoginAttempt($_POST["username"], $_POST["password"])) {
            // Set session or token for authentication
            $user = UserDB::getUserByUsername($_POST["username"]);

            // Start the session if it hasn't been started already
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Store the user_id in a session variable
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["authenticated"] = true;
            // Redirect to home page
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
        session_unset();
        session_destroy();

        // Redirect to login page
        ViewHelper::redirect("login");
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
