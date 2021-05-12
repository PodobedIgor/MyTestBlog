<?php
require __DIR__ . "/../classes/Database.php";
require __DIR__ . "/../classes/Artclass.php";
require __DIR__ . "/../classes/Comment.php";

$database= new Database();
$artclass = new Artclass();
$comment = new Comment();

?>
<header id="header">
<div class="header__top">
  <div class="container">
    <div class="header__top__logo">
      <h1><?php echo $config['name_blog'];?></h1>
    </div>
    <nav class="header__top__menu">
      <ul>
        <li><a href="/Blog/index.php">Home</a></li>
        <li><a href="/Blog/pages/about_blog.php">About blog</a></li>
        <li><a target="_blank" href=<?php echo $config['f_b'];?>>I'm on Facebook</a></li>
      </ul>
    </nav>
  </div>
</div>
<?php
$categories = $database-> get_all_from_table('articles_categories');
?>
<div class="header__bottom">
  <div class="container">
    <nav>
      <ul>
        <?php
        foreach ($categories as $cat) {
            ?>
          <li>
            <a href="/Blog/articles.php?page=1&categorie=<?php echo $cat["id"]; ?>">
              <?php echo $cat["title"]; ?>
            </a>
          </li>
          <?php
        }
        ?>
      </ul>
    </nav>
  </div>
</div>
</header>
