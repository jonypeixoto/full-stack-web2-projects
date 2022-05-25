<?php
    sleep(2);
    include('../../includeConstants.php');
    /**/
    $data['success'] = true;
    $data['message'] = "";

    if(Panel::logged() == false){
        die("You are not logged in!");
    }

    /*Our code starts here!*/

    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['type_customer'];
    $cpf = '';
    $cnpj = '';
    if($type == 'private-individual'){
        $cpf = $_POST['cpf'];
    }else if($type == 'legal-entity'){
        $cnpj = $_POST['cnpj'];
    }
    $image = "";
    if($name == "" || $email == "" || $type == ""){
        $data['success'] = false;
        $data['message'] = "Attention: Empty fields are not allowed!";
    }
    if(isset($_FILES['image'])){
        if(Panel::validImage($_FILES['image'])){
            $image = $_FILES['image'];
        }else{
            $image = "";
            $data['success'] = false;
            $data['message'] = "You are trying to upload an invalid image.";
        }
    }

    if($data['success']){
        if(is_array($image))
            $image = Panel::uploadFile($image);
        $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.customers` VALUES (null,?,?,?,?,?)");
        $dataFinal = ($cpf == '') ? $cnpj : $cpf;
        $sql->execute(array($name,$email,$type,$dataFinal,$image));
        // Everything ok just register!
    }

    die(json_encode($data));

?>