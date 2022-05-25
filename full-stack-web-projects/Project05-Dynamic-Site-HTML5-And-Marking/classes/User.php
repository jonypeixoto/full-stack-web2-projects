<?php

    class User{

        public function updateUser($name,$password,$image){
            $sql = MySql::connect()->prepare("UPDATE `tb_admin.users` SET name = ?,password = ?,img = ? WHERE user = ?");
            if($sql->execute(array($name,$password,$image,$_SESSION['user']))){
                return true;
            }else{
                return false;
            }
        }

        public static function userExists($user){
            $sql = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.users` WHERE user=?");
            $sql->execute(array($user));
            if($sql->rowCount() == 1)
                return true;
            else
                return false;
        }

        public static function registerUser($user,$password,$image,$name,$office){
            $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.users` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($user,$password,$image,$name,$office));
        }

    }
?>