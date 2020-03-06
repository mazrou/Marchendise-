<?php
namespace PHPMVC\Lib\Database;

use mysqli;

class MySQLiDatabaseHandler extends DatabaseHandler
{
    private static $_handler;

    private function __construct(){
        self::init();
    }

    protected static function init()
    {
        try {
            //self::$_handler=new \PDO();
            self::$_handler =new \PDO(
                               'mysql://hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . 'itrad',
                DATABASE_USER_NAME, DATABASE_PASSWORD
            );

        } catch (PDOException $e) {echo 'exep';

        }
    }

    public static function getInstance()
    {
        if(self::$_handler === null) {
            self::$_handler = new self();
        }
        return self::$_handler;
    }

    public function prepare()
    {

    }
}