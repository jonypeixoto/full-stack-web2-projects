<?php  
    verifyPermissionPage(2);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Add User</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                $login = $_POST['login'];
                $name = $_POST['name'];
                $password = $_POST['password'];
                $image = $_FILES['image'];
                $office = $_POST['office'];

                if($login == ''){
                    Panel::alert('error','The login is empty!');
                }else if($name == ''){
                    Panel::alert('error','The name is empty!');
                }else if($password == ''){
                    Panel::alert('error','The password is empty!');
                }else if($office == ''){
                    Panel::alert('error','The office must be selected!');
                }else if($image['name'] == ''){
                    Panel::alert('error','The image must be selected!');
                }else{
                    // We can register!
                    if($office >= $_SESSION['office']){
                        Panel::alert('error','You need to select a position smaller than yours!');
                    }else if(Panel::validImage($image) == false){
                        Panel::alert('error','The specified format is not correct!');
                    }else if(User::userExists($login)){
                        Panel::alert('error','The login already exists, please select another one!');
                    }else{
                        // Only register in the database!
                        $user = new User();
                        $image = Panel::uploadFile($image);
                        $user->registerUser($login,$password,$image,$name,$office);
                        Panel::alert('success','User registration '.$login.' was successful!');
                    }
                }

            }    
        ?>

        <div class="form-group">
            <label>Login:</label>
            <input type="text" name="login">
        </div><!--form-group-->
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name">
        </div><!--form-group-->
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password">
        </div><!--form-group-->

        <div class="form-group">
            <label>Office:</label>
            <select name="office">
                <?php  
                    foreach (Panel::$offices as $key => $value) {
                        if($key < $_SESSION['office']) echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
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