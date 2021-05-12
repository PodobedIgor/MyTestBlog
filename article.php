<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "includes/head.php";
?>
<body>
  <?php
  include "includes/header.php";
  require "classes/Valid.php";
  ?>
  <div id="wrapper">
    <?php
      $article = $artclass -> get_one_article($_GET['id']);
      if (!isset($article)) {
          ?>
        <div id="content">
          <div class="container">
            <div class="row">
              <section class="content__left col-md-8">
                <div class="block">
                  <h1 >Don`t founded</h1>
                  <div class="block__content">
                  <div class="full-text">
                    The article you requested does not obtain!
                    </div>
                  </div>
                </div>
              </section>

              <section class="content__right col-md-4">
                <?php include "includes/sidebar.php"?>
              </section>

            </div>
          </div>
        </div>
        <?php
      } else {
          foreach ($article as $art) {
              $database-> update_views($art['id']);
          } ?>
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a><?php echo $art['views']; ?> views</a>
              <h2><?php echo $art['title']; ?></h2>
              <div class="block__content">
                <img src="static/images/<?php echo $art['image']; ?>" style="max-width: 100%;">
              <div class="full-text"><?php echo $art['text']; ?></div>
              </div>
            </div>
              <div id="comment-add-form" class="block" >
                <h3>Add comment</h3>
                  <div class="block__content">
                    <form class="form" method="POST" action="article.php?id=<?php echo $art['id']; ?>#comment-add-form">
                    <?php
                    if (isset($_COOKIE['successfully'])) {
                        echo $_COOKIE['successfully'];
                        setcookie("successfully", "", time()-3600);
                    };
          if (isset($_POST['do_post'])) {
              $valid = new Valid($_POST);
              try {
                  $valid -> validation();
                  $comment->add_comment($_POST, $art['id']);
                  $success = '<span style="color: green; font-weight: bold; margin-bottom: 10px; display:block;">Comment added successfully!</span>';
                  setcookie("successfully", $success, time()+3600);
                  var_dump($_COOKIE);
                  header("Location:/Blog/article.php?id=" . $art['id']);
              } catch (Exception $ex) {
                  echo '<span style="color: red; font-weight: bold; margin-bottom: 10px; display:block;">'.$ex->getMessage();
              }
          } ?>
                    <div class="form__group">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="name" placeholder="name" value="<?php echo $_POST['name']?? "" ; ?>" >
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="nickname" placeholder="nickname" value="<?php echo $_POST['nickname']?? "" ; ?>">
                        </div>
                        <div class="col-md-3">
                          <input type="email" class="form__control" name="email" placeholder="email" value="<?php echo $_POST['email']?? "" ; ?>">
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="hashtag" placeholder="hashtag" value="<?php echo $_POST['hashtag']?? "" ; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form__group">
                      <textarea name="text" class="form__control" placeholder="Text comment ..."><?php echo $_POST['text']?? "" ; ?></textarea>
                    </div>
                    <div class="form__group">
                      <input type="submit" class="form__control" name="do_post" value="Add comment">
                    </div>
                  </form>
                </div>
              </div>

              <div class="block">
                <a href="#comment-add-form">Add comment</a>
                <h3>Comments</h3>
                <div class="block__content">
                  <div class="articles articles__vertical">

                    <?php

          $comm=$comment->get_comment($art['id']);
          if (($comm) <= 0) {
              echo "No comments!";
          }
          foreach ($comm as $comments) {
              ?>

                        <article class="article">
                          <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($comments['email']); ?>?s=125);"></div>
                          <div class="article__info">
                            <a href="/Blog/article.php?id=<?php echo $comments['articles_id']; ?>"><?php echo $comments['author']; ?></a>
                            <div class="article__info__meta"></div>
                            <div class="article__info__preview"><?php echo $comments['text']; ?></div>
                            <div class="article__info__meta">
                            <a href="/Blog/includes/toptag.php"><?php echo $comments['hashtag']; ?></a>
                          </div>
                        </article>

                        <?php
          } ?>
                  </div>
                </div>
                </div>

          </section>
          <section class="content__right col-md-4">
            <?php include "includes/sidebar.php"?>

          </section>
        </div>
      </div>
    </div>
<?php
      }
?>

  <?php include "includes/footer.php";?>

  </div>

</body>
</html>
