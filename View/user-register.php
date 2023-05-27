<!-- view/user-register.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Register</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>
        <form action="<?= BASE_URL ?>user/register" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" pattern="[a-zA-Z0-9]+" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                <small>Only alphanumeric characters are allowed.</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" minlength="8" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" required>
                <small>Minimum 8 characters required.</small>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '' ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="<?= BASE_URL ?>user/login">Login here</a></p>
    </div>

    <!-- Include Bootstrap JS (at the end of the body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
