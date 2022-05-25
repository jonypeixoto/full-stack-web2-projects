<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Panel::select('tb_site.news','id = ?',array($id));
    }else{
        Panel::alert('error','You need to pass the ID parameter.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit News</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                // Sent my form.

                $name = $_POST['title'];
                $content = $_POST['content'];
                $image = $_FILES['cover'];
                $current_image = $_POST['current_image'];
                $verify = MySql::connect()->prepare("SELECT `id` FROM `tb_site.news` WHERE title = ? AND category_id = ? AND id != ?");
                $verify->execute(array($name,$_POST['category_id'],$id));
                if($verify->rowCount() == 0){
                if($image['name'] != ''){
                    // There is image upload.
                    if(Panel::validImage($image)){
                            Panel::deleteFile($current_image);
                            $image = Panel::uploadFile($image);
                            $slug = Panel::generateSlug($name);
                            $arr = ['title'=>$name,'category_id'=>$_POST['category_id'],'content'=>$content,'cover'=>$image,'slug'=>$slug,'id'=>$id,'name_table'=>'tb_site.news'];
                            Panel::update($arr);
                            $slide = Panel::select('tb_site.news','id = ?',array($id));
                            Panel::alert('success','The news was editted along with the image!');
                    }else{
                        Panel::alert('error','The image format is not valid');
                    }
                }else{
                    $image = $current_image;
                    $slug = Panel::generateSlug($name);
                    $arr = ['title'=>$name,'category_id'=>$_POST['category_id'],'date'=>date('Y-m-d'),'content'=>$content,'cover'=>$image,'slug'=>$slug,'id'=>$id,'name_table'=>'tb_site.news'];
                    Panel::update($arr);
                    $slide = Panel::select('tb_site.news','id = ?',array($id));
                    Panel::alert('success','The news was editted successfully!');
                }
                }else{
                    Panel::alert('error','There is already a news with this name!');
                }
            }
        ?>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="title" required value="<?php echo $slide['title']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Content:</label>
            <textarea class="tinymce" name="content"><?php echo $slide['content']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
        <label>Category:</label>
        <select name="category_id">
            <?php  
                $categories = Panel::selectAll('tb_site.categories');
                foreach ($categories as $key => $value) {
            ?> 
            <option <?php if($value['id'] == $slide['category_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
            <?php } ?>
        </select>
        </div><!--form-group-->

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="cover"/>
            <input type="hidden" name="current_image" value="<?php echo $slide['cover']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="action" value="Update!" required/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->