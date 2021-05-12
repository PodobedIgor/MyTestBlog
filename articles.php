<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php"?>

<body>

  <div id="wrapper">

    <?php include "includes/header.php"?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <?php if ((int) $_GET['categorie'] == NULL)
            {
              ?>
            <div class="block">
              <h3>All articles</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                <?php

                 $per_page = 4;
                 $page = 1;

                 if( isset($_GET['page']))
                 {
                   $page = (int) $_GET['page'];
                 }

                 $total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles`" );
                 $total_count = mysqli_fetch_assoc ($total_count_q);
                 $total_count = $total_count['total_count'];

                 $total_pages = ceil($total_count / $per_page);
                 if($page <= 1 || $page > $total_pages)
                 {
                   $page = 1;
                 }

                 $offset = ($per_page * $page) - $per_page;
                 $articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `pubdate` DESC LIMIT $offset,$per_page" );

                 $articles_exist = true;

                 if (mysqli_num_rows($articles)<=0)
                 {
                   echo "Articles not foud";
                   $articles_exist = false;
                 }

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
                          <small>Category: <a href="articles.php?categorie=<?php echo $art_cat['id'];?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "...");?></div>
                      </div>
                    </article>
                    <?php
                  }
                  ?>
                </div>
                <?php
                if ($articles_exist == true)
                {
                  echo '<div class="paginator">';
                  if ( $page > 1)
                  {
                    echo '<a href="articles.php?page='.($page - 1).'">&laquo; previous</a><br>';
                  }

                  if ( $page < $total_pages)
                  {
                    echo '<a href="articles.php?page='.($page + 1).'">next &raquo;</a>';
                  }

                  echo '</div>';
                }
                ?>

              </div>
            </div>
            <?php
            }
            else {

            ?>

            <div class="block">
              <h3>All articles</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <?php

                 $per_page = 4;
                 $page = 1;

                 if( isset($_GET['page']))
                 {
                   $page = (int) $_GET['page'];
                 }

                 $total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles` WHERE `categorie_id` = " . (int) $_GET['categorie']  );
                 $total_count = mysqli_fetch_assoc ($total_count_q);
                 $total_count = $total_count['total_count'];

                 $total_pages = ceil($total_count / $per_page);
                 if($page <= 1 || $page > $total_pages)
                 {
                   $page = 1;
                 }

                 $offset = ($per_page * $page) - $per_page;
                 $articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = ". (int) $_GET['categorie'] . " ORDER BY `pubdate` DESC LIMIT $offset, $per_page"  );


                 $articles_exist = true;

                 if (mysqli_num_rows($articles)<=0)
                 {
                   echo "Articles not foud";
                   $articles_exist = false;
                 }

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
                          <small>Category: <a href="articles.php?categorie=<?php echo $art_cat['id'];?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "...");?></div>
                      </div>
                    </article>
                    <?php
                  }
                  ?>
                </div>
                <?php
                if ($articles_exist == true)
                {
                  echo '<div class="paginator">';
                  if ( $page > 1)
                  {
                    echo '<a href="articles.php?page='.($page - 1).'&categorie='. (int) $_GET['categorie'] .'">&laquo; previous</a><br>';
                  }

                  if ( $page < $total_pages)
                  {
                    echo '<a href="articles.php?page='.($page + 1).'&categorie='. (int) $_GET['categorie'] .'">next &raquo;</a>';
                  }

                  echo '</div>';
                }
                ?>

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
