<?php

    class Site{

        public static function updateUserOnline(){
            if(isset($_SESSION['online'])){
                $token = $_SESSION['online'];
                $currentClock = date('Y-m-d H:i:s');
                $check = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
                $check->execute(array($_SESSION['online']));

                if($check->rowCount() == 1){
                    $sql = MySql::connect()->prepare("UPDATE `tb_admin.online` SET last_action = ? WHERE token = ?");
                    $sql->execute(array($currentClock,$token));
                }else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $token = $_SESSION['online'];
                    $currentClock = date('Y-m-d H:i:s');
                    $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
                    $sql->execute(array($ip,$currentClock,$token));
                }
            }else{
                $_SESSION['online'] = uniqid();
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $currentClock = date('Y-m-d H:i:s');
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
                $sql->execute(array($ip,$currentClock,$token));
            }
        }

        public static function counter(){
            // testing cookie on database
            // setcookie('visit','true',time() - 1);
            if(!isset($_COOKIE['visit'])){
                setcookie('visit','true',time() + (60*60*24*7));
                $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visits` VALUES (null,?,?)");
                $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
            }
        }

    }

?>