<?php 
    if(isset($_GET['delete'])){
        $idDelete = intval($_GET['delete']);
        Panel::delet('tb_site.categories',$idDelete);
        $news = MySql::connect()->prepare("SELECT * FROM `tb_site.news` WHERE category_id = ?");
        $news->execute(array($idDelete));
        $news = $news->fetchAll();
        foreach ($news as $key => $value) {
            $imgDelete = $value['cover']; 
            Panel::deleteFile($imgDelete);
        }
        $news = MySql::connect()->prepare("DELETE FROM `tb_site.news` WHERE category_id = ?");
        $news->execute(array($idDelete));
        Panel::redirect(INCLUDE_PATH_PANEL.'manage-categories');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
		Panel::orderItem('tb_site.categories',$_GET['order'],$_GET['id']);
	}

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $byPage = 4;
    
    $categories = Panel::selectAll('tb_site.categories',($currentPage - 1) * $byPage,$byPage);

?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Registered Categories</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>Name</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php
            foreach ($categories as $key => $value) {
        ?>

        <tr>
			<td><?php echo $value['name']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-category?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PANEL ?>manage-categories?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>manage-categories?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>manage-categories?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

        <?php } ?>

    </table>
    </div><!--wraper-table-->

    <div class="pagination">
        <?php
            $totalPages = ceil(count(Panel::selectAll('tb_site.categories')) / $byPage);

            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PANEL.'manage-categories?page='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PANEL.'manage-categories?page='.$i.'">'.$i.'</a>';

            }

        ?>
    </div><!--pagination-->
</div><!--box-content-->