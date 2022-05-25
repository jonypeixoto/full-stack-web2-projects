<?php  
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $testimonial = Panel::select('tb_site.testimonials','id = ?',array($id));
    }else{
        Panel::alert('error','You need to pass the ID parameter.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit Testimonial</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
			if(isset($_POST['action'])){
				if(Panel::update($_POST)){
					Panel::alert('success','The registration was eddited successful!');
                    $testimonial = Panel::select('tb_site.testimonials','id = ?',array($id));
				}else{
					Panel::alert('error','Empty fields are not allowed.');
				}
			}
		?>

        <div class="form-group">
            <label>Name's person:</label>
            <input type="text" name="name" value="<?php echo $testimonial['name']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Testimonial:</label>
            <textarea name="testimonial"><?php echo $testimonial['testimonial']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Date:</label>
            <input format="date" type="text" name="date" value="<?php echo $testimonial['date']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name_table" value="tb_site.testimonials" />
            <input type="submit" name="action" value="Update!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->