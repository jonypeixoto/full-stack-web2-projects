<?php
    $site = Panel::select('tb_site.config',false);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit Site Settings</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
			if(isset($_POST['action'])){
				if(Panel::update($_POST,true)){
					Panel::alert('success','The site was editted successful!');
                    $site = Panel::select('tb_site.config',false);
				}else{
					Panel::alert('error','Empty fields are not allowed.');
				}
			}
		?>

        <div class="form-group">
			<label>Site Title:</label>
			<input type="text" name="title" value="<?php echo $site['title'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Site author name:</label>
			<input type="text" name="name_author" value="<?php echo $site['name_author'] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Site author description:</label>
			<textarea name="description"><?php echo $site['description']; ?></textarea>
		</div><!--form-group-->

		<?php
			for($i = 1; $i <= 3; $i++){
		?>
    
		<div class="form-group">
			<label>Icon <?php echo $i; ?>:</label>
			<input type="text" name="icon<?php echo $i; ?>" value="<?php echo $site['icon'.$i] ?>" />
		</div><!--form-group-->

		<div class="form-group">
			<label>Icon Description <?php echo $i; ?>:</label>
			<textarea name="description<?php echo $i; ?>"><?php echo $site['description'.$i]; ?></textarea>
		</div><!--form-group-->

		<?php } ?>

		<div class="form-group">
			<input type="hidden" name="name_table" value="tb_site.config" />
			<input type="submit" name="action" value="Update!">
		</div><!--form-group-->

	</form>

</div><!--box-content-->