<?php



class DB {

    private static $db_connect;

    public static $host = "localhost";

    public static $username = "root";

    public static $password = "";

    public static $database = "example";


    public static function connect() {
        self::$db_connect = new mysqli(self::$host,self::$username,self::$password,self::$database) or die("Ошибка подключения к базе даних  (".self::$db_connect -> connect_errno."): ".self::$db_connect -> connect_error);
    }

    public static function query($query = "",$res = 0) {
        self::connect();
        return self::$db_connect->query($query);
    }

    public static function createTable($table = "") {
        $sql = file_get_contents("http://".$_SERVER['HTTP_HOST']."/database/create/".$table);
        self::query($sql) or die("ошибка создания таблицы");
    }


}