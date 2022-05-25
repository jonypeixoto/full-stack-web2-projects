<?php 
    if(isset($_GET['delete'])){
        $idDelete = intval($_GET['delete']);
        $selectImage = MySql::connect()->prepare("SELECT slide FROM `tb_site.slides` WHERE id = ?");
        $selectImage->execute(array($_GET['delete']));

        $image = $selectImage->fetch()['slide'];
        Panel::deleteFile($image);
        Panel::delet('tb_site.slides',$idDelete);
        Panel::redirect(INCLUDE_PATH_PANEL.'list-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
		Panel::orderItem('tb_site.slides',$_GET['order'],$_GET['id']);
	}

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $byPage = 4;
    
    $slides = Panel::selectAll('tb_site.slides',($currentPage - 1) * $byPage,$byPage);

?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Slides Registered</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>Name</td>
            <td>Image</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php
            foreach ($slides as $key => $value) {
        ?>

        <tr>
			<td><?php echo $value['name']; ?></td>
			<td><img style="width: 50px;height:50px;" src="<?php echo INCLUDE_PATH_PANEL ?>uploads/<?php echo $value['slide']; ?>" /></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-slide?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PANEL ?>list-slides?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-slides?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-slides?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

        <?php } ?>

    </table>
    </div><!--wraper-table-->

    <div class="pagination">
        <?php
            $totalPages = ceil(count(Panel::selectAll('tb_site.slides')) / $byPage);

            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PANEL.'list-slides?page='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PANEL.'list-slides?page='.$i.'">'.$i.'</a>';

            }

        ?>
    </div><!--pagination-->
</div><!--box-content-->