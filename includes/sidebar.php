<div class="block">
  <h3>Top read articles</h3>
  <div class="block__content">
    <div class="articles articles__vertical">
      <?php
        $articles = $artclass -> get_top_read_articles();
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
                <small>Сategory: <a href="/Blog/articles.php?page=1&categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
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

  <div class="block">
  <h3>Comments</h3>
  <div class="block__content">
    <div class="articles articles__vertical">
      <?php
        $comm = $comment->get_comment();
        foreach ($comm as $comments) {
            ?>
          <article class="article">
            <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($comments['email']); ?>?s=125);"></div>
            <div class="article__info">
              <a href="/Blog/article.php?id=<?php echo $comments['articles_id']; ?>"><?php echo $comments['author']; ?></a>
              <div class="article__info__meta"></div>
              <div class="article__info__preview"><?php echo $str = mb_strimwidth(strip_tags($comments['text']), 0, 70, "..."); ?></div>
            </div>
          </article>
          <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="block">
    <h3>No read articles</h3>
      <div class="block__content">
        <div class="articles articles__vertical">
              <?php
                $articles = $artclass -> get_top_no_read_articles();
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
                         <small>Сategory: <a href="/Blog/articles.php?page=1&categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
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
