<header id="header">
  <div class="header__top">
    <div class="container">
      <div class="header__top__logo">
        <h1><?php echo $config['name_blog'];?></h1>
      </div>
      <nav class="header__top__menu">
        <ul>
          <li><a href="/Blog/index.php">Home</a></li>
          <li><a href="/Blog/pages/about_me.php">About blog</a></li>
          <li><a target="_blank" href=<?php echo $config['f_b'];?>>I'm on Facebook</a></li>
        </ul>
      </nav>
    </div>
  </div>
  <?php
  $categories_q = mysqli_query($connection, "SELECT * FROM `articles_categories`");
  $categories = array();
  while ( $cat = mysqli_fetch_assoc ($categories_q) )
  {
    $categories[] = $cat;
  }
  ?>
  <div class="header__bottom">
    <div class="container">
      <nav>
        <ul>
          <?php
          foreach ($categories as $cat)
          {
            ?>
            <li><a href="/articles.php?categorie=<?php echo $cat["id"]; ?>"><?php
            echo $cat["title"];?></a></li>

            <?php
          }
          ?>
        </ul>
      </nav>
    </div>
  </div>
</header>
