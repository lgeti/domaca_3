<?php

require_once("model/ChatDB.php");
require_once("ViewHelper.php");

class ChatController {

    public static function index() {
        ViewHelper::render("view/chat-ws.php");
    }

    public static function add() {
        $rules = [
            "user" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^\w+[ ]*\w+$/"]
            ],
            "message" => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if ($data["user"] !== false && !empty($data["message"])) {
            ChatDB::insert($data["user"], $data["message"]);
        } else {
            throw new Exception("Missing / incorrect data");
        }
    }

    public static function delete() {
        ChatDB::deleteAll();
        ViewHelper::redirect(BASE_URL . "chat");
    }
}
