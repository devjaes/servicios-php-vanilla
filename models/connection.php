<?php

class Connection
{
    private $DB_HOST;
    private $DB_NAME;
    private $DB_USER;
    private $DB_PASSWORD;
    private $DB_OPTIONS;

    private static $connection;

    public function __construct()
    {
        $this->DB_HOST = "localhost";
        $this->DB_NAME = "soa";
        $this->DB_USER = "root";
        $this->DB_PASSWORD = "";
        $this->DB_OPTIONS = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    }

    public static function connect()
    {
        if (!isset(self::$connection)) {
            $connection = new Connection();
            try {
                self::$connection = new PDO(
                    "mysql:host="
                        . $connection->DB_HOST . ";dbname=" . $connection->DB_NAME,
                    $connection->DB_USER,
                    $connection->DB_PASSWORD,
                    $connection->DB_OPTIONS
                );
            } catch (Exception $e) {
                die(json_encode(array($e->getMessage())));
            }
        }
        return self::$connection;
    }
}
