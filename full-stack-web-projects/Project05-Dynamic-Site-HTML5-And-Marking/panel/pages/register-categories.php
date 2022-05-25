<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Register Category</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                $name = $_POST['name'];
                if($name == ''){
                    Panel::alert('error','The name field can not be empty!');
                }else{
                    // Only register in the database!
                $verify = MySql::connect()->prepare("SELECT * FROM `tb_site.categories` WHERE name = ?");
                $verify->execute(array($_POST['name']));
                    if($verify->rowCount() == 0){
                    $slug = Panel::generateSlug($name);

                    $arr = ['name'=>$name,'slug'=>$slug,'order_id'=>'0','name_table'=>'tb_site.categories'];
                    Panel::insert($arr);
                    Panel::alert('success','The category registration was successful!');
                    }else{
                        Panel::alert("error","There is already a category with this name!");
                    }
                }
            }    
        ?>

        <div class="form-group">
            <label>Category name:</label>
            <input type="text" name="name">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="action" value="Register!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->