<?php

    $tokenHotmart = '999999';

    // Substituir pelo post da Hotmart
    $hotmartPost = '999999';
    if(isset($hotmartPost)){
        if($tokenHotmart == $hotmartPost){
            // O POST É DA HOTMART
            $email = 'cybertimeuptestes@proton.me';
            $status = 'approved';
            if($status == 'approved'){
                // Inserir no banco o acesso ao curso
                // No nosso caso está na tabela tb_admin.curso_controle
            }
        }
    }

?>