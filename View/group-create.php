<?php 
    if (session_status() === PHP_SESSION_NONE) {
                session_start();
        }
    if (!isset($_SESSION['user_id'])) {
        ViewHelper::render("view/group-selection.php", [
            "errorMessage" => "You must be logged in to create a group.",
            "groups" => GroupDB::getAllGroups()
        ]);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Group</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navigation.php'; ?>
    <div class="container">
        <h1>Create Group</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <form action="create" method="POST">
            <div class="mb-3">
                <label for="groupName" class="form-label">Group Name:</label>
                <input type="text" id="groupName" name="groupName" class="form-control" value="<?= isset($_POST['groupName']) ? $_POST['groupName'] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" name="description" class="form-control" value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>">
            </div>
            <button type="submit" class="btn btn-primary">Create Group</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
