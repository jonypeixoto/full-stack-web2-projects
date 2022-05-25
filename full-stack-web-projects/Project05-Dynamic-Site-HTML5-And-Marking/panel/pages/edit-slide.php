<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $slide = Panel::select('tb_site.slides','id = ?',array($id));
    }else{
        Panel::alert('error','You need to pass the ID parameter.');
        die();
    }
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                // Sent my form.

                $name = $_POST['name'];
                $image = $_FILES['image'];
                $current_image = $_POST['current_image'];

                if($image['name'] != ''){
                    
                    // There is image upload.
                    if(Panel::validImage($image)){
                            Panel::deleteFile($current_image);
                            $image = Panel::uploadFile($image);
                            $arr = ['name'=>$name,'slide'=>$image,'id'=>$id,'name_table'=>'tb_site.slides'];
                            Panel::update($arr);
                            $slide = Panel::select('tb_site.slides','id = ?',array($id));
                            Panel::alert('success','The slide was editted along with the image!');
                    }else{
                        Panel::alert('error','The image format is not valid');
                    }
                }else{
                    $image = $current_image;
                    $arr = ['name'=>$name,'slide'=>$image,'id'=>$id,'name_table'=>'tb_site.slides'];
                    Panel::update($arr);
                    $slide = Panel::select('tb_site.slides','id = ?',array($id));
                    Panel::alert('success','The slide was editted successfully!');
                }
            }
        ?>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" required value="<?php echo $slide['name']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image"/>
            <input type="hidden" name="current_image" value="<?php echo $slide['slide']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="action" value="Update!" required/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->