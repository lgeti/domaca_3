<?php

require_once "models/MessageDB.php";

class MessageController {
    public function sendMessage($groupId, $userId, $message) {
        // Validate input if needed

        // Send the message
        MessageDB::insertMessage($groupId, $userId, $message);

        // Redirect or display success message
    }

    public function getGroupMessages($groupId) {
        // Get the messages for the specified group
        $messages = MessageDB::getMessagesByGroup($groupId);

        // Display the messages or pass them to a view
    }
    
    public function getUserMessages($userId) {
        // Get the messages for the specified user
        $messages = MessageDB::getMessagesByUser($userId);

        // Display the messages or pass them to a view
    }
}
