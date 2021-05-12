<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "includes/config.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'];?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="media/css/style.css">
</head>
<body>

  <div id="wrapper">

    <?php include "includes/header.php"?>


    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="articles.php">All</a>
              <h3>New in blog</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <?php
                // function art () {
                //  global $connection;
                //  return mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `pubdate` DESC LIMIT 6" );}
                // $articles = art();
                 $art = function() use($connection) {
                  return mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `pubdate` DESC LIMIT 6" );};
                  $articles = $art();
                  while ($art = mysqli_fetch_assoc($articles))
                  {
                    ?>

                    <article class="article">
                      <div class="article__image" style="background-image: url(/Blog/static/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                        <a href="/Blog/article.php?id=<?php echo $art['id'];?>"><?php echo $art['title'];?></a>
                        <div class="article__info__meta">
                          <?php
                          $art_cat = false;
                          foreach ($categories as $cat)
                          {
                          if( $cat['id'] == $art['categorie_id'])
                          {
                          $art_cat = $cat;
                          break;
                          }
                          }
                          ?>
                          <small>Category: <a href="/articles.php?categorie=<?php echo $art_cat['id'];?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "...");?></div>
                      </div>
                    </article>

                    <?php
                    }
                  ?>

                </div>
              </div>
            </div>

            <?php
              foreach ($categories as $category) {
                         ?>
            <div class="block">
              <a href="/articles.php?categorie=<?php echo $category['id']?>">All</a>
              <?php $title = mysqli_query($connection, 'SELECT `title` FROM `articles_categories` WHERE `id` =' . $category['id'] . ';' );
                $tit = mysqli_fetch_assoc($title);
                echo '<h3>'.$tit['title'].'</h3>'; ?>

                <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php  $articles = mysqli_query($connection, 'SELECT * FROM `articles` WHERE `categorie_id` =' . $category['id'] . ' ORDER BY `pubdate` DESC LIMIT 4' );

                    while ($art = mysqli_fetch_assoc($articles))
                    {
                      ?>

                      <article class="article">
                        <div class="article__image" style="background-image: url(/Blog/static/images/<?php echo $art['image']; ?>);"></div>
                        <div class="article__info">
                          <a href="/Blog/article.php?id=<?php echo $art['id'];?>"><?php echo $art['title'];?></a>
                          <div class="article__info__meta">
                            <small>Сategory: <a href="/articles.php?categorie=<?php echo $category['id'];?>"><?php echo $category['title']; ?></a></small>
                          </div>
                          <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "...");?></div>
                        </div>
                      </article>

                      <?php
                    }
                    ?>

                </div>
              </div>
            </div>
            <?php
          }
            ?>

          </section>
          <section class="content__right col-md-4">
            <?php include "includes/sidebar.php"?>
          </section>
        </div>
      </div>
    </div>



  </div>

  <?php include "includes/footer.php";?>

</body>
</html>
