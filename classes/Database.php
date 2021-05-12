<?php

class Database
{
    private $serverName;
    private $userName;
    private $passCode;
    private $dbName;
    public $connect;

    public function __construct()
    {
        $this -> serverName = 'localhost';
        $this -> userName = 'Podobed';
        $this -> passCode = '6568238';
        $this -> dbName = 'Blog';
        $this -> connect();
    }

    public function connect()
    {
        $this -> connect =  mysqli_connect($this -> serverName, $this -> userName, $this -> passCode, $this -> dbName);
    }

    public function get_all_from_table($name)
    {
        $query_result = mysqli_query($this -> connect, "SELECT * FROM $name");

        return $this->pretty_data($query_result);
    }

    public function pretty_data($result)
    {
        $items = array();
        while ($item = mysqli_fetch_assoc($result)) {
            $items[] = $item;
        }

        return $items;
    }



    public function update_views($art)
    {
        mysqli_query($this -> connect, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $art);
    }

    public function get_top_tag()
    {
        $query_result = mysqli_query($this -> connect, "SELECT `hashtag`,count(*) AS `count` FROM `comments` GROUP BY `hashtag` HAVING `count` > 1 ORDER BY `count` DESC LIMIT 10");
        return $this->pretty_data($query_result);
    }
}
