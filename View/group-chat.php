
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $group['name']; ?></title>
    <link rel="stylesheet" type="text/css" href="../style/groupStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <?php include 'navigation.php'; ?>
    <h1 class="text-center mb-4"><?php echo $group['name']; ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="chat-container">
                    <h2>Chat Messages</h2>
                    <ul id="chat-messages">
                        <!-- Display chat messages here -->
                    </ul>
                    <?php if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]):?>
                    <form id="chat-form">
                        <div class="input-group mb-3">
                            <input type="text" id="message-input" class="form-control" placeholder="Type your message...">
                            <button id="button" type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                    <?php else: ?>
                        <!-- User is not logged in -->
                        <p>Please <a href="user/login">login</a> to chat.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="recipe-container">
                    <?php if (isset($_SESSION['user_id'])):
                        $username = $_SESSION['username']; ?>
                        <h2>Add Recipe</h2>
                        <form id="recipe-form" action="add-recipe" method="POST">
                            <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea id="description" name="description" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients:</label>
                                <textarea id="ingredients" name="ingredients" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="instructions" class="form-label">Instructions:</label>
                                <textarea id="instructions" name="instructions" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Recipe</button>
                        </form>
                    <?php endif; ?>
                    <h2>Recipes</h2>
                    <div id="recipes">
                        <?php foreach ($recipes as $recipe): ?>
                            <div class="recipe">
                                <h3><?php echo $recipe['title']; ?></h3>
                                <p><?php echo $recipe['description']; ?></p>
                                <p><strong>Ingredients:</strong> <?php echo $recipe['ingredients']; ?></p>
                                <p><strong>Instructions:</strong> <?php echo $recipe['instructions']; ?></p>
                                <p><strong>Author:</strong> <?php echo UserDB::getUser($recipe['user_id'])['username']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <!-- User is not logged in -->
                        <p>Please <a href="user/login">login</a> to add recipes.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $loggedIn = isset($_SESSION['username']) ? true : false; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="<?= "../assets/jquery-3.2.1.min.js" ?>"></script>
    <script>

        "use strict"
        <?php if ($loggedIn): ?>
            $(document).ready(() => {
                // Web socket
                const conn = new WebSocket('ws://localhost:9999');
                conn.onopen = function(e) {
                    console.log("Connection established!");
                };
                conn.onmessage = function(event) {
                    const ul = $("#chat-messages")
                    const li = document.createElement("li")
                    const data = JSON.parse(event.data)
                    li.innerText = `${data.user}: ${data.message}`
                    ul.append(li);
                };

                $("#chat-form").submit(event => {
                    event.preventDefault();
                    const textarea = $("#message-input");
                    const message = textarea.val().trim();

                    if (message == "") {
                        return;
                    }

                    textarea.val("");
                    textarea.focus();

                    let user = "<?php echo $username; ?>";
                    console.log(user);
                    // send data
                    conn.send(JSON.stringify({ user, message }));
                });
            });
        <?php endif; ?>
    </script>

</body>
</html>
