<?php 
    if(isset($_GET['delete'])){
        $idDelete = intval($_GET['delete']);
        Panel::delet('tb_site.testimonials',$idDelete);
        Panel::redirect(INCLUDE_PATH_PANEL.'list-testimonials');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
		Panel::orderItem('tb_site.testimonials',$_GET['order'],$_GET['id']);
	}

    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $byPage = 4;
    
    $testimonials = Panel::selectAll('tb_site.testimonials',($currentPage - 1) * $byPage,$byPage);
?>
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Testimonials Registered</h2>
    <div class="wraper-table">
    <table>
        <tr>
            <td>Name</td>
            <td>Date</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php
            foreach ($testimonials as $key => $value) {
        ?>
        <tr>
            <td><?php echo $value['name']; ?></td>
            <td><?php echo $value['date']; ?></td>
            <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-testimonial?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PANEL ?>list-testimonials?delete=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Delete</a></td>
            <td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-testimonials?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PANEL ?>list-testimonials?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
        </tr>

        <?php } ?>

    </table>
    </div><!--wraper-table-->

    <div class="pagination">
        <?php
            $totalPages = ceil(count(Panel::selectAll('tb_site.testimonials')) / $byPage);

            for($i = 1; $i <= $totalPages; $i++){
                if($i == $currentPage)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PANEL.'list-testimonials?page='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PANEL.'list-testimonials?page='.$i.'">'.$i.'</a>';

            }

        ?>
    </div><!--pagination-->
</div><!--box-content-->