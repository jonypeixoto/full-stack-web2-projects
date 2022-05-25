<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Register Slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                $name = $_POST['name'];
                $image = $_FILES['image'];
                if($name == ''){
                    Panel::alert('error','The name field can not be empty!');
                }else{
                    // We can register!
                    if(Panel::validImage($image) == false){
                        Panel::alert('error','The specified format is not correct!');
                    }else{
                        // Only register in the database!
                        include('../classes/lib/WideImage.php');
                        $image = Panel::uploadFile($image);
                        //WideImage::load('uploads/'.$image)->resize(100)->rotate(180)->saveToFile('uploads/'.$image);
                        $arr = ['name'=>$name,'slide'=>$image,'order_id'=>'0','name_table'=>'tb_site.slides'];
                        Panel::insert($arr);
                        Panel::alert('success','The slide registration was successful!');
                    }
                }
            }    
        ?>

        <div class="form-group">
            <label>Slide's Name:</label>
            <input type="text" name="name">
        </div><!--form-group-->

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="action" value="Register!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->