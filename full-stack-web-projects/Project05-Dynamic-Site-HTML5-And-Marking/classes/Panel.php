<?php

    class Panel 
    {
        
        public static $offices = [
            '0' => 'Normal',
            '1' => 'Sub Administrator',
            '2' => 'Administrator'];

        public static function loadJS($files,$page){
            $url = explode('/',@$_GET['url'])[0];
            if($page == $url){
                foreach ($files as $key => $value) {
                    echo '<script src="'.INCLUDE_PATH_PANEL.'js/'.$value.'"></script>';
                }
            }
        }

        public static function generateSlug($str){
            $str = mb_strtolower($str);
            $str = preg_replace('/(â|à|á|ã)/', 'a', $str);
            $str = preg_replace('/(ê|é)/', 'e', $str);
            $str = preg_replace('/(í|Í)/', 'i', $str);
            $str = preg_replace('/(ú)/', 'u', $str);
            $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
            $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
            $str = preg_replace('/( )/', '-',$str);
            $str = preg_replace('/ç/','c',$str);
            $str = preg_replace('/(-[-]{1,})/','-',$str);
            $str = preg_replace('/(,)/','-',$str);
            $str=strtolower($str);
            return $str;
        }
    
        public static function logged(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function logout(){
            setcookie('remember','true',time()-1,'/');
            session_destroy();
            header('Location: '.INCLUDE_PATH_PANEL);
        }

        public static function loadPage(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    // Page not exist!
                    header('Location: '.INCLUDE_PATH_PANEL);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function listOnlineUsers(){
            self::clearOnlineUsers();
            $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.online`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function clearOnlineUsers(){
            $date = date('Y-m-d H:i:s');
            $sql = MySql::connect()->exec("DELETE FROM `tb_admin.online` WHERE last_action < '$date' - INTERVAL 1 MINUTE");
        }

        public static function alert($type,$message){
            if($type == 'success'){
                echo '<div class="box-alert success"><i class="fa fa-check"></i> '.$message.'</div>';
            }else if($type == 'error'){
                echo '<div class="box-alert error"><i class="fa fa-times"></i> '.$message.'</div>';
            }
        }

        public static function validImage($image){
            if($image['type'] == 'image/jpeg' || 
                $image['type'] == 'image/jpg' || 
                $image['type'] == 'image/png'){

                $size = intval($image['size']/1024);
                if($size < 300)
                    return true;
                else
                    return false;
            }else{
                return false;
            }
        }

        public static function uploadFile($file){
            $formatFile = explode('.',$file['name']);
            $imageName = uniqid().'.'.$formatFile[count($formatFile) - 1];
            if(move_uploaded_file($file['tmp_name'],BASE_DIR_PANEL.'/uploads/'.$imageName))
                return $imageName;
            else
                return false;
        }

        public static function deleteFile($file){
            @unlink('uploads/'.$file);
        }

        public static function insert($arr){
            $correct = true;
            $name_table = $arr['name_table'];
            $query = "INSERT INTO `$name_table` VALUES (null";
            foreach ($arr as $key => $value) {
                $name = $key;
                $amount = $value;
                if($name == 'action' || $name == 'name_table')
                    continue;
                if($value == ''){
                    $correct = false;
                    break;
                }
                $query.=",?";
                $parameters[] = $value;
            }

            $query.=")";
            if($correct == true){
                $sql = MySql::connect()->prepare($query);
                $sql->execute($parameters);
                $lastId = MySql::connect()->lastInsertId();
                $sql = MySql::connect()->prepare("UPDATE `$name_table` SET order_id = ? WHERE id = $lastId");
                $sql->execute(array($lastId));
            }
            return $correct;
        }

        public static function update($arr,$single = false){
            $correct = true;
            $first = false;
            $name_table = $arr['name_table'];
            $query = "UPDATE `$name_table` SET ";
            foreach ($arr as $key => $value) {
                $name = $key;
                $amount = $value;
                if($name == 'action' || $name == 'name_table' || $name == 'id')
                    continue;
                if($value == ''){
                    $correct = false;
                    break;
                }
                
                if($first == false){
                    $first = true;
                    $query.="$name=?";
                }
                else{
                    $query.=",$name=?";
                }

                $parameters[] = $value;
            }
            
            if($correct == true){
                if($single == false){
                    $parameters[] = $arr['id'];
                    $sql = MySql::connect()->prepare($query.' WHERE id=?');
                    $sql->execute($parameters);
                }else{
                    $sql = MySql::connect()->prepare($query);
                    $sql->execute($parameters);
                }
            }
            return $correct;
        }

        public static function selectAll($table,$start = null,$end = null){
            if($start == null && $end == null)
                $sql = MySql::connect()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC");
            else
                $sql = MySql::connect()->prepare("SELECT * FROM `$table` ORDER BY order_id ASC LIMIT $start,$end");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function delet($table,$id=false){
            if($id == false){
                $sql = MySql::connect()->prepare("DELETE FROM `$table`");
            }else{
                $sql = MySql::connect()->prepare("DELETE FROM `$table` WHERE id = $id");
            }
            $sql->execute();
        }

        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        /*
            Specific method to select only 1 register.
        */
        public static function select($table,$query = '',$arr = ''){
            if($query != false){
                $sql = MySql::connect()->prepare("SELECT * FROM `$table` WHERE $query");
                $sql->execute($arr);
            }else{
                $sql = MySql::connect()->prepare("SELECT * FROM `$table`");
                $sql->execute();
            }
            return $sql->fetch();
        }

        public static function orderItem($table,$orderType,$idItem){
            if($orderType == 'up'){

                $infoCurrentItem = Panel::select($table,'id=?',array($idItem));
                $order_id = $infoCurrentItem['order_id'];
                $itemBefore = MySql::connect()->prepare("SELECT * FROM `$table` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
				$itemBefore->execute();
                if($itemBefore->rowCount() == 0)
					return;
                $itemBefore = $itemBefore->fetch();
                Panel::update(array('name_table'=>$table,'id'=>$itemBefore['id'],'order_id'=>$infoCurrentItem['order_id']));
                Panel::update(array('name_table'=>$table,'id'=>$infoCurrentItem['id'],'order_id'=>$itemBefore['order_id']));
            }else if($orderType == 'down'){
                $infoCurrentItem = Panel::select($table,'id=?',array($idItem));
                $order_id = $infoCurrentItem['order_id'];
                $itemBefore = MySql::connect()->prepare("SELECT * FROM `$table` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
				$itemBefore->execute();
                if($itemBefore->rowCount() == 0)
					return;
                $itemBefore = $itemBefore->fetch();
                Panel::update(array('name_table'=>$table,'id'=>$itemBefore['id'],'order_id'=>$infoCurrentItem['order_id']));
                Panel::update(array('name_table'=>$table,'id'=>$infoCurrentItem['id'],'order_id'=>$itemBefore['order_id']));
            }
        }

    }
?>