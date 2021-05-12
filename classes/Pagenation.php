<?php
class Pagenation extends Database
{
    public $valpage;
    public $per_page;
    public $current_page;
    public $total_pages;

    public function current_page()
    {
        $this->per_page = 4;
        $this->set_current_page = 1;
        if (isset($this->valpage)) {
            return $this->current_page = (int) $this->valpage;
        }
    }
    public function total_pages()
    {
        $total_count_q = mysqli_query($this->connect, "SELECT COUNT(`id`) AS `total_count` FROM `articles`");
        $total_count = mysqli_fetch_assoc($total_count_q);
        $total_count = $total_count['total_count'];
        return $this->total_pages = ceil($total_count/ $this->per_page);
    }

    public function get_articles()
    {
        if ($this->current_page <= 1 || $this->current_page > $this->total_pages) {
            $set_current_page = 1;
        }
        $offset = ($this->per_page * $this->current_page) - $this->per_page;
        return $articles = mysqli_query($this->connect, "SELECT * FROM `articles` ORDER BY `pubdate` DESC LIMIT $offset,$this->per_page");
    }
}

class Pagenation_one_cat extends Pagenation
{
    public $cat_id;

    public function total_pages()
    {
        $total_count_q = mysqli_query($this->connect, "SELECT COUNT(`id`) AS `total_count` FROM `articles` WHERE `categorie_id` = " . (int) $this->cat_id);
        $total_count = mysqli_fetch_assoc($total_count_q);
        $total_count = $total_count['total_count'];
        return $this->total_pages = ceil($total_count/ $this->per_page);
    }

    public function get_articles()
    {
        if ($this->current_page <= 1 || $this->current_page > $this->total_pages) {
            $set_current_page = 1;
        }
        $offset = ($this->per_page * $this->current_page) - $this->per_page;
        return $articles = mysqli_query($this->connect, "SELECT * FROM `articles` WHERE `categorie_id` = ". (int) $this->cat_id . " ORDER BY `pubdate` DESC LIMIT $offset,$this->per_page");
    }
}
