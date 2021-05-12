<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 ?>
<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . "/head.php";
?>
<body>

  <div id="wrapper">

    <?php include  __DIR__  . "/header.php"; ?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h1 >Top hashtag :</h1>
              <div class="block__content">
                <ul>
                  <?php
                  $tag = $database -> get_top_tag();
                  foreach ($tag as $toptag) {
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
