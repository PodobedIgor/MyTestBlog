<?php
require '../includes/config.php';
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

    <?php include "../includes/header.php"?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h1 >Top hashtag :</h1>
              <div class="block__content">
                <ul>
                  <?php

                  $tag = mysqli_query ($connection, "SELECT `hashtag`,count(*) AS `count` FROM `comments` GROUP BY `hashtag` HAVING `count` > 1 ORDER BY `count` DESC LIMIT 10");
                    while ($toptag = mysqli_fetch_assoc($tag)) {

                   echo '<h1><li><br>' . $toptag['hashtag']. ' count ' . $toptag['count'] . '<hr></li></h1>';

                  }
                      ?>
                </ul>
              </div>
            </div>

          </section>
          <section class="content__right col-md-4">
            <?php include "../includes/sidebar.php"?>

          </section>
        </div>
      </div>
    </div>

  <?php include "../includes/footer.php";?>

  </div>

</body>
</html>
