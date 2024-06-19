<?php 

class DBInit {

    private static $host;
    private static $user;
    private static $password;
    private static $schema;
    private static $instance = null;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    /**
     * Returns a PDO instance -- a connection to the database.
     * The singleton instance assures that there is only one connection active
     * at once (within the scope of one HTTP request)
     * 
     * @return PDO instance 
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$host = getenv('DB_HOST');
            self::$user = getenv('DB_USER');
            self::$password = getenv('DB_PASSWORD');
            self::$schema = getenv('DB_SCHEMA');

            $config = "sqlsrv:server=" . self::$host
                    . ";Database=" . self::$schema;
            try {
                self::$instance = new PDO($config, self::$user, self::$password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error connecting to SQL Server: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}