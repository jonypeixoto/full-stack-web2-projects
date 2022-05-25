<?php 
    if(isset($_GET['delete'])){
        $idDelete = intval($_GET['delete']);
        Panel::delet('tb_site.services',$idDelete);
        Panel::redirect(INCLUDE_PATH_PANEL.'list-services');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
		Panel::orderItem('tb_site.services',$_GET['order'],$_GET['id']);
	}

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $byPage = 4;
    
    $services = Panel::selectAll('tb_site.services',($currentPage - 1) * $byPage,$byPage);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Services Registered</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>Service</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php
            foreach ($services as $key => $value) {
        ?>
        <tr>
            <td><?php echo $value['service']; ?></td>
            <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-service?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PANEL ?>list-services?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Delete</a></td>
            <td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-services?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-services?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>

        <?php } ?>

    </table>
    </div><!--wraper-table-->

    <div class="pagination">
        <?php
            $totalPages = ceil(count(Panel::selectAll('tb_site.services')) / $byPage);

            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PANEL.'list-services?page='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PANEL.'list-services?page='.$i.'">'.$i.'</a>';

            }

        ?>
    </div><!--pagination-->
</div><!--box-content-->