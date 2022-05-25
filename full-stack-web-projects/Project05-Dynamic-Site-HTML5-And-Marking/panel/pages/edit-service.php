<?php  
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $service = Panel::select('tb_site.services','id = ?',array($id));
    }else{
        Panel::alert('error','You need to pass the ID parameter.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit Service</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
			if(isset($_POST['action'])){
				if(Panel::update($_POST)){
					Panel::alert('success','The service was eddited successful!');
                    $service = Panel::select('tb_site.services','id = ?',array($id));
				}else{
					Panel::alert('error','Empty fields are not allowed.');
				}
			}
		?>

        <div class="form-group">
            <label>Service:</label>
            <textarea name="service"><?php echo $service['service']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name_table" value="tb_site.services" />
            <input type="submit" name="action" value="Update!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->