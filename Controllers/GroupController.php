<?php

require_once "models/GroupDB.php";

class GroupController {
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

    public function deleteGroup($groupId) {
        // Delete the group
        GroupDB::deleteGroup($groupId);

        // Redirect or display success message
    }
}
