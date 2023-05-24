<?php

session_start();

require_once("controller/UserController.php");
require_once("controller/GroupController.php");
require_once("controller/RecipeController.php");
require_once("controller/MessageController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("ASSETS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "assets/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "user/register" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::registerUser();
        } else {
            UserController::showRegistrationForm();
        }
    },
    "user/login" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::login();
        } else {
            UserController::showLoginForm();
        }
    },
    "user/logout" => function () {
        UserController::logout();
    },
    "group/create" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            GroupController::create();
        } else {
            GroupController::showCreationForm();
        }
    },
    "group/view" => function () {
        GroupController::view();
    },
    "group/join" => function () {
        GroupController::join();
    },
    "recipe/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            RecipeController::add();
        } else {
            RecipeController::showAddForm();
        }
    },
    "recipe/view" => function () {
        RecipeController::view();
    },
    "message/send" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            MessageController::send();
        } else {
            MessageController::showSendForm();
        }
    },
    // Other routes...
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
    // Handle the error appropriately, e.g., redirect to an error page
}
