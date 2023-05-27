<!DOCTYPE html>
<html>
<head>
    <title>Group Chat</title>
    <style>
        .recipe {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .recipe h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>Group Chat</h1>

    <div id="chat-messages">
        <!-- Display chat messages here -->
    </div>

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

    <form id="chat-form">
        <input type="text" id="message-input" placeholder="Type your message...">
        <button type="submit">Send</button>
    </form>

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
