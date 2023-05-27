<!DOCTYPE html>
<html>
<head>
    <title><?php echo $group['name']; ?></title>
    <link rel="stylesheet" type="text/css" href="../style/groupStyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center mb-4"><?php echo $group['name']; ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="chat-container">
                    <h2>Chat Messages</h2>
                    <div id="chat-messages">
                        <!-- Display chat messages here -->
                        <div class="message">
                            <span class="sender">John:</span>
                            <span class="content">Hello, everyone!</span>
                        </div>
                        <div class="message">
                            <span class="sender">Emma:</span>
                            <span class="content">Hi, John!</span>
                        </div>
                    </div>

                    <form id="chat-form">
                        <div class="input-group mb-3">
                            <input type="text" id="message-input" class="form-control" placeholder="Type your message...">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="recipe-container">
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

                    <h2>Recipes</h2>
                    <div id="recipes">
                        <?php foreach ($recipes as $recipe): ?>
                            <div class="recipe">
                                <h3><?php echo $recipe['title']; ?></h3>
                                <p><?php echo $recipe['description']; ?></p>
                                <p><strong>Ingredients:</strong> <?php echo $recipe['ingredients']; ?></p>
                                <p><strong>Instructions:</strong> <?php echo $recipe['instructions']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your JavaScript code to handle chat functionality -->
    <script>
        // Example JavaScript code for handling chat functionality
        // You will need to customize this code based on your requirements

        // Get the chat form element
        const chatForm = document.getElementById('chat-form');

        // Add an event listener to submit the form
        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Get the message input value
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;
            // TODO: Handle sending the message to the server and updating the chat messages
            // You can use AJAX, fetch, or websockets to send the message to the server
            // and update the chat messages dynamically without refreshing the page.
            // After sending the message, you can clear the input field:
            messageInput.value = '';
        });
    </script>

</body>
</html>
