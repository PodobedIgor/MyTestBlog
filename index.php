<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "includes/head.php";
?>
<body>
  <?php
  include "includes/header.php";
  ?>
  <div id="wrapper">
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="articles.php?page=1">All</a>
              <h3>New in blog</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">

                <?php
                $articles = $artclass->get_articles();
                 foreach ($articles as $art) {
                     ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(/Blog/static/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                        <a href="/Blog/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                        <div class="article__info__meta">
                          <?php
                          $art_cat = false;
                     foreach ($categories as $cat) {
                         if ($cat['id'] == $art['categorie_id']) {
                             $art_cat = $cat;
                             break;
                         }
                     } ?>
                          <small>Category: <a href="/Blog/articles.php?page=1&categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "..."); ?></div>
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
              <a href="/Blog/articles.php?page=1&categorie=<?php echo $category['id']?>">All</a>
              <?php
                echo '<h3>'.$category['title'].'</h3>'; ?>

                <div class="block__content">
                <div class="articles articles__horizontal">

                  <?php
                    $articles = $artclass -> get_articles($category['id']);
                  foreach ($articles as $art) {
                      ?>
                      <article class="article">
                        <div class="article__image" style="background-image: url(/Blog/static/images/<?php echo $art['image']; ?>);"></div>
                        <div class="article__info">
                          <a href="/Blog/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                          <div class="article__info__meta">
                            <small>Сategory: <a href="/articles.php?page=1&categorie=<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a></small>
                          </div>
                          <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "..."); ?></div>
                        </div>
                      </article>
                      <?php
                  } ?>

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
