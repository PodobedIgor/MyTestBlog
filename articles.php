    <!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<body>

  <div id="wrapper">

    <?php
    include "includes/header.php";
    include "classes/Pagenation.php";

    ?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <?php if (!isset($_GET['categorie'])) {
        $pagenation = new Pagenation();
        $pagenation->valpage=$_GET['page'];
        $current_page = $pagenation->current_page();
        $total_pages = $pagenation->total_pages();
        $get_articles = $pagenation->get_articles();
        $articles_exist = true;
        if (mysqli_num_rows($get_articles) == 0) {
            echo "Articles not foud";
            $articles_exist = true;
        }
    } else {
        $pagenation_one_cat= new Pagenation_one_cat();
        $pagenation_one_cat->valpage=$_GET['page'];
        $pagenation_one_cat->cat_id=$_GET['categorie'];
        $current_page= $pagenation_one_cat->current_page();
        $total_pages = $pagenation_one_cat->total_pages();
        $get_articles = $pagenation_one_cat->get_articles();
        $articles_exist = true;

        if (mysqli_num_rows($get_articles) == 0) {
            echo "Articles not found";
            $articles_exist = true;
        }
    }

            ?>
            <div class="block">
              <h3>All articles</h3>
              <div class="block__content">
                <div class="articles articles__horizontal">
                <?php
                  foreach ($get_articles as $art) {
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
                          <small>Category: <a href="articles.php?page=1&categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
                        </div>
                        <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($art['text']), 0, 70, "..."); ?></div>
                      </div>
                    </article>
                <?php
                  }
                ?>
                </div>
                <?php
                if ($articles_exist == true && isset($_GET['categorie'])) {
                    echo '<div class="paginator">';
                    if ($current_page > 1) {
                        echo '<a href="articles.php?page='.($current_page - 1).'&categorie='. (int) $_GET['categorie'] .'">&laquo; previous</a><br>';
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="articles.php?page='.($current_page + 1).'&categorie='. (int) $_GET['categorie'] .'">next &raquo;</a>';
                    }

                    echo '</div>';
                } else {
                    if ($articles_exist == true) {
                        echo '<div class="paginator">';
                        if ($current_page> 1) {
                            echo '<a href="articles.php?page='.($current_page - 1).'">&laquo; previous</a><br>';
                        }

                        if ($current_page < $total_pages) {
                            echo '<a href="articles.php?page='.($current_page + 1).'">next &raquo;</a>';
                        }

                        echo '</div>';
                    }
                }
                 ?>
              </div>
            </div>

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
