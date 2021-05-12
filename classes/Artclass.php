<?php

class Artclass extends Database
{
    public function get_articles($id = null)
    {
        if ($id != null) {
            $query_result = mysqli_query($this->connect, "SELECT * FROM `articles` WHERE `categorie_id` = $id ORDER BY `pubdate` DESC LIMIT 4");
            return $this->pretty_data($query_result);
        }

        $query_result = mysqli_query($this->connect, "SELECT * FROM `articles` ORDER BY `pubdate` DESC LIMIT 6");
        return $this->pretty_data($query_result);
    }

    public function get_top_read_articles()
    {
        $query_result = mysqli_query($this->connect, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 5");
        return $this->pretty_data($query_result);
    }

    public function get_top_no_read_articles()
    {
        for ($i=1; $i <=5 ; $i++) {
            $articlesSql[$i] = mysqli_query($this->connect, "SELECT * FROM `articles` WHERE `categorie_id`= $i ORDER BY `views` LIMIT 1 ");
        }
        $articles = array();
        foreach ($articlesSql as $articl) {
            $art = mysqli_fetch_assoc($articl);
            $articles[$art['views']] = $art;
        }
        ksort($articles);
        return $articles;
    }

    public function get_one_article($article_id)
    {
        $query_result = mysqli_query($this->connect, "SELECT * FROM `articles` WHERE `id` = " . (int) $article_id);
        return $this->pretty_data($query_result);
    }
}
