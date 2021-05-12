<?php

require "Database.php";

class Crud extends Database
{
    public function insert_article($data)
    {
        mysqli_query($this -> connect, "INSERT INTO `articles`(`title`, `image`, `text`, `categorie_id`)
        VALUES ('".$data['title']."','".$data['image']."','".$data['text']."',
        '".$data['categorie_id']."')");
    }

    public function get_articles()
    {
        $query_result = mysqli_query($this->connect, "SELECT * FROM `articles` ORDER BY `pubdate`");
        return $this->pretty_data($query_result);
    }

    public function update_articles($dat, $id)
    {
        $art_text = mysqli_real_escape_string($this->connect, $dat['text']);
        $query_result = mysqli_query($this->connect, "UPDATE  `articles` SET `id`='".$dat['id']."',`title`='".$dat['title']."',`image`='".$dat['image']."',
        `text`='".$art_text."', `categorie_id`='".$dat['categorie_id']."',`pubdate`='".$dat['pubdate']."',`views`='".$dat['views']."' WHERE `id`= $id");
    }

    public function delete_articles($id)
    {
        $query_result = mysqli_query($this->connect, "DELETE FROM `articles` WHERE `id`=$id ");
    }
}
