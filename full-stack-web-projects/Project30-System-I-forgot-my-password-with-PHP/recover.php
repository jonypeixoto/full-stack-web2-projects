<?php
    session_start();
    if(isset($_POST['action'])){
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['token'] = uniqid();

?>
    Clique <a href="recover.php?token=<?php echo $_SESSION['token']; ?>">here</a> to redefine your password.
<?php
    }else if($_GET['token']){
        $token = $_GET['token'];
            if($token != $_SESSION['token']){
                die('The token does not match');
            }else{
                //You can redefine tha password here
                echo 'Redefine password to the email '.$_SESSION['email'];
                echo '<form method="post">
                    <input type="password" name="password">
                    <input type="submit" name="redefine" value="Send">
                </form>';
            }

?>
<?php
    }
?>
<?php
   if(isset($_POST['redefine'])){
       echo 'Password was defined sucessfully!';
   } 
?>