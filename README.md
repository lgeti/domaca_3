To set up the web application locally using XAMPP, follow these steps:

Install XAMPP, which includes an Apache web server and MySQL database.

Copy the repository folder ("domaca_3") of the web application into the xampp/htdocs/ folder on your local machine.

Start the XAMPP control panel and turn on the Apache server and MySQL database.

Open a web browser and navigate to localhost/phpmyadmin.

In phpMyAdmin, go to the Import tab and select the option to import a database.

Locate the "db.sql" file inside the "sql" folder of the repository and import it into your database.

For the chat functionality to work, navigate to the "websocket" folder in the repository and run the "server.php" script.

Everything is now set up. You can test the web application by opening your preferred browser and accessing localhost/domaca_3.

Already created users:
    username, password;
    pero, trapero;
    risto, traktoristo;
    riki, m@rtin;

Feel free to create more.