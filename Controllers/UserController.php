<?php

require_once "UserDB.php";

class UserController {

    public function registerUser($username, $password) {
        // Validate input data (e.g., check if username is unique, password requirements, etc.)
        if (empty($username) || empty($password)) {
            // Handle invalid input, display error message, redirect to registration page, etc.
            // ...
            return;
        }

        // Check if the username is already taken
        if (UserDB::getUserByUsername($username) !== null) {
            // Handle username already exists, display error message, redirect to registration page, etc.
            // ...
            return;
        }

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Call the UserDB method to insert the user into the database
        UserDB::insertUser($username, $hashedPassword);

        // Optionally, you can perform additional actions after successful registration (e.g., redirect to login page, send email confirmation, etc.)
        // ...
        // Redirect to login page or display success message
        // ...
    }

    public function loginUser($username, $password) {
        // Retrieve user from the database based on the provided username
        $user = UserDB::getUserByUsername($username);

        // Verify the provided password against the stored hashed password
        if ($user !== null && password_verify($password, $user['password'])) {
            // Successful login, perform necessary actions (e.g., set session, redirect to home page, etc.)
            // ...
            // Set session or token for authentication
            // ...
            // Redirect to home page or display success message
            // ...
        } else {
            // Invalid username or password, handle the error (e.g., display error message, redirect to login page, etc.)
            // ...
            // Display error message or redirect to login page
            // ...
        }
    }

    public function logoutUser() {
        // Perform necessary actions to log out the user (e.g., clear session, redirect to login page, etc.)
        // ...
        // Clear session or token for authentication
        // ...
        // Redirect to login page or display success message
        // ...
    }

    public function updateUser($userId, $username, $password) {
        // Validate input data (e.g., check if username is unique, password requirements, etc.)
        if (empty($username) || empty($password)) {
            // Handle invalid input, display error message, redirect to user profile page, etc.
            // ...
            return;
        }

        // Check if the new username is already taken by another user
        $existingUser = UserDB::getUserByUsername($username);
        if ($existingUser !== null && $existingUser['id'] !== $userId) {
            // Handle username already exists, display error message, redirect to user profile page, etc.
            // ...
            return;
        }

        // Hash the password before updating it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Call the UserDB method to update the user in the database
        UserDB::updateUser($userId, $username, $hashedPassword);

        // Optionally, you can perform additional actions after successful update (e.g., redirect to user profile page, display success message, etc.)
        // ...
        // Redirect to user profile page or display success message
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
