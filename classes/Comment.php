<?php

class Comment extends Database
{
    public function get_comment($id = null)
    {
        if ($id != null) {
            $query_result = mysqli_query($this->connect, "SELECT * FROM `comments` WHERE `articles_id`  = " .(int) $id. " ORDER BY `id` DESC");
            return $this->pretty_data($query_result);
        }
        $query_result = mysqli_query($this->connect, "SELECT * FROM `comments` ORDER BY `pubdate` DESC LIMIT 5");
        return $this->pretty_data($query_result);
    }

    public function add_comment($data, $art_id)
    {
        mysqli_query($this->connect, "INSERT INTO `comments` (`author`,`nickname`,`email`,`text`,`articles_id`,`hashtag`) VALUES ('".$data['name']."','".$data['nickname']."','".$data['email']."',
      '".$data['text']."','".$art_id."','".$data['hashtag']."')");
    }
}
