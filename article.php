<?php
require 'includes/config.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title'];?></title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/Blog/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/Blog/media/css/style.css">
</head>
<body>

  <div id="wrapper">

    <?php include "includes/header.php"?>

    <?php
      $article = mysqli_query ($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);

      if (mysqli_num_rows($article) <= 0)
      {
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
      } else
      {
        $art = mysqli_fetch_assoc ($article);
        mysqli_query ($connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $art['id']);
    ?>
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a><?php echo $art['views'];?> views</a>
              <h2><?php echo $art['title'];?></h2>
              <div class="block__content">
              <img src="static/images/<?php echo $art['image'];?>" style="max-width: 100%;">
              <div class="full-text"><?php echo $art['text'];?></div>
              </div>
            </div>

              <div id="comment-add-form" class="block" >
                <h3>Add comment</h3>
                <div class="block__content">
                  <form class="form" method="POST" action="article.php?id=<?php echo $art['id']; ?>#comment-add-form">
                    <?php

                    if( isset($_POST['do_post']) )
                    {
                      $errors = array();

                      if ($_POST['name'] == '' )
                      {
                        $errors[] = 'Enter your name!';
                      }

                      if ($_POST['nickname'] == '')
                       {
                        $errors[] = 'Enter your nickname!';
                      }

                      if ($_POST['email'] == '')
                       {
                        $errors[] = 'Enter your email!';
                      }

                      if ($_POST['text'] == '')
                       {
                        $errors[] = 'Enter your text comment!';
                      }
                      if ($_POST['hashtag'] == '')
                       {
                        $errors[] = 'Enter your hashtag!';
                      }
                       else
                       {
                         $regexp1 = "/#\b.*[a-z]+.*\b/i";

                         $truetag1 = preg_match_all($regexp1, $_POST['hashtag']);
                         if ($truetag1 == false )
                        {
                          $errors[] = 'Enter "#"!';
                         }
                         else {$regexp2 = "/^[^0-9 ]+$/i";
                              $truetag2 = preg_match_all($regexp2, $_POST['hashtag']);}
                              if($truetag2 == false) {
                                $errors[] = 'Pleace delete space!';
                               }
                       }
                      if (empty($errors))
                      {
                        //Add Comments
                        mysqli_query($connection,"INSERT INTO `comments` (`author`,`nickname`,`email`,`text`,`articles_id`,`hashtag`) VALUES ('".$_POST['name']."','".$_POST['nickname']."','".$_POST['email']."',
                        '".$_POST['text']."','".$art['id']."','".$_POST['hashtag']."')" );
                        //  header("Location: /Blog/article.php?id=$art[id]");
                        // exit;
                        ?>
                        <span style="color: green; font-weight: bold; margin-bottom: 10px; display:block;">Comment added successfully!</span>
                        <meta http-equiv="refresh" content="2, URL='/Blog/article.php?id=<?php echo $art['id']; ?>#comment-add-form'">
                      <?php
                      } else

                      {
                        //Add error
                       echo '<span style="color: red; font-weight: bold; margin-bottom: 10px; display:block;">'.$errors['0'].'</span>';
                      }
                    }

                    ?>

                    <div class="form__group">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="name" placeholder="name" value="<?php echo $_POST['name'];?>" >
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="nickname" placeholder="nickname" value="<?php echo $_POST['nickname'];?>">
                        </div>
                        <div class="col-md-3">
                          <input type="email" class="form__control" name="email" placeholder="email" value="<?php echo $_POST['email'];?>">
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form__control" name="hashtag" placeholder="hashtag" value="<?php echo $_POST['hashtag'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="form__group">
                      <textarea name="text" class="form__control" placeholder="Text comment ..."><?php echo $_POST['text'];?></textarea>
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
                      $comments = mysqli_query($connection, "SELECT * FROM `comments` WHERE `articles_id` = " . (int) $art['id'] . " ORDER BY `id` DESC ");
                      if (mysqli_num_rows($comments) <= 0)
                       {
                        echo "No comments!";
                      }
                      while ($comment = mysqli_fetch_assoc($comments))
                      {
                        ?>

                        <article class="article">
                          <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($comment['email']); ?>?s=125);"></div>
                          <div class="article__info">
                            <a href="/Blog/article.php?id=<?php echo $comment['articles_id'];?>"><?php echo $comment['author'];?></a>
                            <div class="article__info__meta"></div>
                            <div class="article__info__preview"><?php echo $comment['text'];?></div>
                            <div class="article__info__meta">
                            <a href="/Blog/includes/toptag.php"><?php echo $comment['hashtag'];?></a>
                          </div>
                        </article>

                        <?php
                      }
                      ?>
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
