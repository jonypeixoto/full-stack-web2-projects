<?php 
    if(isset($_GET['delete'])){
        $idDelete = intval($_GET['delete']);
        $selectImage = MySql::connect()->prepare("SELECT cover FROM `tb_site.news` WHERE id = ?");
        $selectImage->execute(array($_GET['delete']));

        $image = $selectImage->fetch()['cover'];
        Panel::deleteFile($image);
        Panel::delet('tb_site.news',$idDelete);
        Panel::redirect(INCLUDE_PATH_PANEL.'manage-news');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
		Panel::orderItem('tb_site.news',$_GET['order'],$_GET['id']);
	}

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $byPage = 4;
    
    $news = Panel::selectAll('tb_site.news',($currentPage - 1) * $byPage,$byPage);

?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> News Registered</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>Title</td>
            <td>Category</td>
            <td>Image</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php
            foreach ($news as $key => $value) {
            $nameCategory = Panel::select('tb_site.categories','id=?',array($value['category_id']))['name'];
        ?>

        <tr>
			<td><?php echo $value['title']; ?></td>
			<td><?php echo $nameCategory; ?></td>
			<td><img style="width: 50px;height:50px;" src="<?php echo INCLUDE_PATH_PANEL ?>uploads/<?php echo $value['cover']; ?>" /></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-news?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PANEL ?>manage-news?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>manage-news?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>manage-news?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

        <?php } ?>

    </table>
    </div><!--wraper-table-->

    <div class="pagination">
        <?php
            $totalPages = ceil(count(Panel::selectAll('tb_site.news')) / $byPage);

            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PANEL.'manage-news?page='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PANEL.'manage-news?page='.$i.'">'.$i.'</a>';

            }

        ?>
    </div><!--pagination-->
</div><!--box-content-->