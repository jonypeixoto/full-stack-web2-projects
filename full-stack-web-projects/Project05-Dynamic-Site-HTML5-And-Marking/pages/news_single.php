<?php
    $url = explode('/',$_GET['url']);

    $verify_category = MySql::connect()->prepare("SELECT * FROM `tb_site.categories` WHERE slug = ?");
    $verify_category->execute(array($url[1]));
    if($verify_category->rowCount() == 0){
        Panel::redirect(INCLUDE_PATH.'news');
    }
    $category_info = $verify_category->fetch();

    $post = MySql::connect()->prepare("SELECT * FROM `tb_site.news` WHERE slug = ? AND category_id = ?");
    $post->execute(array($url[2],$category_info['id']));
    if($post->rowCount() == 0){
        Panel::redirect(INCLUDE_PATH.'news');
    }

    // it's because my news exists
    $post = $post->fetch();

?>
<section class="news-single">
    <div class="center">
    <header>
        <h1><i class="fa fa-calendar"></i> <?php echo $post['date'] ?> - <?php echo $post['title'] ?></h1>
    </header>
    <article>
        <?php echo $post['content']; ?>
    </article>
    </div><!--center-->
</section>