<?php
    if(isset($_COOKIE['remember'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.users` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['office'] = $info['office'];
            $_SESSION['name'] = $info['name'];
            $_SESSION['img'] = $info['img'];
            
            // DELETE header('Location: '.INCLUDE_PATH_PANEL);
            // die();
            // And Change TO Panel::redirect(INCLUDE_PATH_PANEL);
            // When you put ONLINE in the SERVER:
            
            /*

            header('Location: '.INCLUDE_PATH_PANEL);
            die();

            BY:

            Panel::redirect(INCLUDE_PATH_PANEL);

            */

            header('Location: '.INCLUDE_PATH_PANEL);
            die();

        }
    }
?>
<DOCTYPE html>
<html>
<head>
    <title>Control Panel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PANEL ?>css/style.css" rel="stylesheet" />
</head>
<body>

<div class="box-login">
        <?php
            if(isset($_POST['action'])){
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.users` WHERE user = ? AND password = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    // We logged in successfully.
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['office'] = $info['office'];
                    $_SESSION['name'] = $info['name'];
                    $_SESSION['img'] = $info['img'];
                    if(isset($_POST['remember'])){
                        setcookie('remember',true,time()+(60*60*24),'/');
                        setcookie('user',$user,time()+(60*60*24),'/');
                        setcookie('password',$password,time()+(60*60*24),'/');
                    }

                    // DELETE header('Location: '.INCLUDE_PATH_PANEL);
                    // die();
                    // And Change TO Panel::redirect(INCLUDE_PATH_PANEL);
                    // When you put ONLINE in the SERVER:

                    /*

                    header('Location: '.INCLUDE_PATH_PANEL);

                    BY:

                    Panel::redirect(INCLUDE_PATH_PANEL);

                    */

                    header('Location: '.INCLUDE_PATH_PANEL);
                    die();

                }else{
                    // Failed!
                    echo '<div class="error-box"><i class="fa fa-times"></i> Incorrect username or password!</div>';
                }
            }
        ?>
        <h2>Log in:</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Login..." required>
            <input type="password" name="password" placeholder="Password..." required>
            <div class="form-group-login left">
                <input type="submit" name="action" value="Log in!">
            </div>
            <div class="form-group-login right">
                <label>Remember</label>
                <input type="checkbox" name="remember" />
            </div>
            <div class="clear"></div>
        </form>
</div><!--box-login-->

</body>
</html>