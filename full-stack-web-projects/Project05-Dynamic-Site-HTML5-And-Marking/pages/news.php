<?php
    $url = explode('/',$_GET['url']);
    if(!isset($url[2]))
    {
    $category = MySql::connect()->prepare("SELECT * FROM `tb_site.categories` WHERE slug = ?");
    $category->execute(array(@$url[1]));
    $category = $category->fetch();
?>
<section class="header-news">
    <div class="center">
        <h2><i class="fa fa-bell-o" aria-hidden="true"></i></h2>
        <h2 style="font-size: 21px;">Follow the <b>news on the portal</b></h2>
    </div><!--center-->
</section>

<section class="container-portal">
    <div class="center">

        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3><i class="fa fa-search"></i> Search here:</h3>
                <form method="post">
                    <input type="text" name="parameter" placeholder="What do you want to look for?" required>
                    <input type="submit" name="search" value="Search!">
                </form>
            </div><!--box-content-sidebar-->
            <div class="box-content-sidebar">
                <h3><i class="fa fa-list-ul" aria-hidden="true"></i> Select category:</h3>
                <form>
                    <select name="category">
                    <option value="" selected="">All categories</option>
                        <?php  
                            $categories = MySql::connect()->prepare("SELECT * FROM `tb_site.categories` ORDER BY order_id ASC");
                            $categories->execute();
                            $categories = $categories->fetchAll();
                            foreach ($categories as $key => $value) {

                        ?>
                            <option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug'] ?>"><?php echo $value['name']; ?></option>
                        <?php } ?>

                    </select>
                </form>
            </div><!--box-content-sidebar-->
            <div class="box-content-sidebar">
                <h3><i class="fa fa-user" aria-hidden="true"></i> About the author:</h3>
                    <div class="author-box-portal">
                        <div class="box-img-author"></div>
                        <div class="text-author-portal text-center">
                            <?php
                                $infoSite = MySql::connect()->prepare("SELECT * FROM `tb_site.config`");
                                $infoSite->execute();
                                $infoSite = $infoSite->fetch();
                            ?>
                            <h3><?php echo $infoSite['name_author'] ?></h3>
                            <p><?php echo substr($infoSite['description'],0,300).'...' ?></p>
                        </div><!--text-author-portal-->
                    </div><!--author-box-portal-->
            </div><!--box-content-sidebar-->
        </div><!--sidebar-->

        <div class="content-portal">
            <div class="header-content-portal">
                <?php
                    $byPage = 10;
                    if(!isset($_POST['parameter'])){
                    if($category['name'] == ''){
                        echo '<h2>Viewing all posts</h2>';
                    }else{
                        echo '<h2>Viewing Posts in <span>'.$category['name'].'</span></h2>';
                    }
                    }else{
                        echo '<h2><i class="fa fa-check"></i> Search performed successfully!</h2>';
                    }

                    $query = "SELECT * FROM `tb_site.news` ";
                    if($category['name'] != ''){
                        $category['id'] = (int)$category['id'];
                        $query.="WHERE category_id = $category[id]";
                    }
                    if(isset($_POST['parameter'])){
                        if(strstr($query,'WHERE') !== false){
                            $search = $_POST['parameter'];
                            $query.=" AND title LIKE '%$search%'";
                        }else{
                            $search = $_POST['parameter'];
                            $query.=" WHERE title LIKE '%$search%'";
                        }
                    }
                    $query2 = "SELECT * FROM `tb_site.news` ";
                    if($category['name'] != ''){
                        $category['id'] = (int)$category['id'];
                        $query2.="WHERE category_id = $category[id]";
                    }
                    if(isset($_POST['parameter'])){
                        if(strstr($query2,'WHERE') !== false){
                            $search = $_POST['parameter'];
                            $query2.=" AND title LIKE '%$search%'";
                        }else{
                            $search = $_POST['parameter'];
                            $query2.=" WHERE title LIKE '%$search%'";
                        }
                    }
                    $totalPages = MySql::connect()->prepare($query2);
                    $totalPages->execute();
                    $totalPages = ceil($totalPages->rowCount() / $byPage);
                    if(!isset($_POST['parameter'])){
                        if(isset($_GET['page'])){
                            $page = (int)$_GET['page'];
                            if($page > $totalPages){
                                $page = 1;
                            }

                            $queryPg = ($page - 1) * $byPage;
                            $query.=" ORDER BY order_id ASC LIMIT $queryPg,$byPage";
                        }else{
                            $page = 1;
                            $query.=" ORDER BY order_id ASC LIMIT 0,$byPage";
                        }
                    }else{

                        $query.=" ORDER BY order_id ASC";
                    }
                    $sql = MySql::connect()->prepare($query);
                    $sql->execute();
                    $news = $sql->fetchAll();
                ?>

            </div><!--header-content-portal-->
            <?php
                foreach($news as $key=>$value){
                $sql = MySql::connect()->prepare("SELECT `slug` FROM `tb_site.categories` WHERE id = ?");
                $sql->execute(array($value['category_id']));
                $categoryName = $sql->fetch()['slug'];
            ?>
            <div class="box-single-content">
                <h2><?php echo date('d/m/Y',strtotime($value['date'])) ?> - <?php echo $value['title']; ?></h2>
                <p><?php echo substr(strip_tags($value['content']),0,400).'...'; ?></p>
                <a href="<?php echo INCLUDE_PATH; ?>news/<?php echo $categoryName; ?>/<?php echo $value['slug']; ?>">Read more</a>
            </div><!--box-single-content-->
            <?php } ?>

            <div class="paginator">
                <?php  
                    if(!isset($_POST['parameter'])){
                    for($i = 1; $i <= $totalPages; $i++){
                        $catStr = ($category['name'] != '') ? '/'.$category['slug'] : '';
                        if($page == $i)
                            echo '<a class="active-page" href="'.INCLUDE_PATH.'news'.$catStr.'?page='.$i.'">'.$i.'</a>';
                        else
                            echo '<a href="'.INCLUDE_PATH.'news'.$catStr.'?page='.$i.'">'.$i.'</a>';
                    }
                    }
                ?>
                
            </div><!--paginator-->
        </div><!--content-portal-->

        <div class="clear"></div>
    </div><!--center-->

</section><!--container-portal-->

<?php }else{ 
    include('news_single.php');
} 
?>
    