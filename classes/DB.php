<?php
/**
 * Created by PhpStorm.
 * User: verba
 * Date: 25.09.19
 * Time: 20:46
 */

//namespace NEWS;

class DB
{
    //CREATE DATABASE test_news;

    protected static $instance = null;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance === null) {
            $driver = 'mysql';
            //$host = 'db3.ho.ua';
          $host = 'localhost';
            $port = ''; //3306
            $dbname = 'test_news';
			//$username = 'verbastudio';
            $username = 'verba';
			//$password = 'DKqdCDudfv';
            $password = 'password';
            $charset = 'utf8';
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => TRUE,
            );
            $dsn = $driver . ':host=' . $host . ';dbname=' . $dbname . ($charset == false) ?: ';charset=' . $charset;
            self::$instance = (new PDO($dsn, $username, $password, $opt));
            self::$instance->exec("set names " . $charset);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function query($sql, $args = [])
    {
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

}


function newsCreator()
{
    $tempnews = [
            'post_name' => 'news ',
            'post_body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ];
    return $tempnews;
}

class CheckDb
{
    public function createTable()
    {
        $s = 'CREATE TABLE test_news.news (`id` int(11) AUTO_INCREMENT,`post_name` TEXT NOT NULL,`post_body` TEXT NOT NULL,`status` int(11) DEFAULT 0,`date_added` timestamp NULL DEFAULT NULL,`date_update` timestamp NULL DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';
        $t = DB::prepare($s);
        $t->execute();
        $t->rowCount();
    }

}
//$checkDb = (new CheckDb())->createTable();
