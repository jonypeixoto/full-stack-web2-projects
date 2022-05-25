<?php  
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $category = Panel::select('tb_site.categories','id = ?',array($id));
    }else{
        Panel::alert('error','You need to pass the ID parameter.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit Category</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
			if(isset($_POST['action'])){
                $slug = Panel::generateSlug($_POST['name']);
                $arr = array_merge($_POST,array('slug'=>$slug));
                $verify = MySql::connect()->prepare("SELECT * FROM `tb_site.categories` WHERE name = ? AND id != ?");
                $verify->execute(array($_POST['name'],$id));
                if($verify->rowCount() == 1){
                    Panel::alert("error",'There is already a category with this name!');
                }else{
				if(Panel::update($arr)){
					Panel::alert('success','The category was eddited successful!');
                    $category = Panel::select('tb_site.categories','id = ?',array($id));
				}else{
					Panel::alert('error','Empty fields are not allowed.');
				}
                }
			}
		?>

        <div class="form-group">
            <label>Category:</label>
            <input type="text" name="name" value="<?php echo $category['name']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="name_table" value="tb_site.categories" />
            <input type="submit" name="action" value="Update!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->