<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Edit User</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                // Sent my form.

                $name = $_POST['name'];
                $password = $_POST['password'];
                $image = $_FILES['image'];
                $current_image = $_POST['current_image'];
                $user = new User();
                if($image['name'] != ''){
                    
                    // There is image upload.
                    if(Panel::validImage($image)){
                            Panel::deleteFile($current_image);
                            $image = Panel::uploadFile($image);
                            if($user->updateUser($name,$password,$image)){
                                $_SESSION['img'] = $image;
                                Panel::alert('success','Updated successfully along with the image!');
                            }else{
                                Panel::alert('error','An error occurred while updating along with the image...');
                            }
                        }else{
                            Panel::alert('error','The image format is not valid');
                        }
                }else{
                    $image = $current_image;
                    $user = new User();
                    if($user->updateUser($name,$password,$image)){
                        Panel::alert('success','Updated successfully!');
                    }else{
                        Panel::alert('error','An error occurred while updating...');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" required value="<?php echo $_SESSION['name']; ?>">
        </div><!--form-group-->
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image"/>
            <input type="hidden" name="current_image" value="<?php echo $_SESSION['img']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <input type="submit" name="action" value="Update!" required/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->