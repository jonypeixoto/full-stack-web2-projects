<?php

    session_start();
    date_default_timezone_set('Europe/London');
    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/PHPMailerAutoload.php');
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);

    define('INCLUDE_PATH','https://localhost/full-stack-web2-projects/full-stack-projects/Project15-3-Dynamic-Site-and-Control-Panel-AdvancedPHP-and-Systems/');
    define('INCLUDE_PATH_PANEL',INCLUDE_PATH.'panel/');

    define('BASE_DIR_PANEL',__DIR__.'/panel');

    
    //Connected with database!
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','project_01');

    //Contants to the control panel
    define('NAME_COMPANY','CybertimeUP');
  
    //Functions of the panel 
    function takeOffice($index){
        return Panel::$offices[$index];
    }

    function selectedMenu($par){
        /*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){
            echo 'class="menu-active"';
        }
    }

    function verifyPermissionMenu($permission){
        if($_SESSION['office'] >= $permission){
            return;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verifyPermissionPage($permission){
        if($_SESSION['office'] >= $permission){
            return;
        }else{
            include('panel/pages/permission_denied.php');
            die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }
?>