
<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Registered Customers</h2>

    <div class="boxes">
        <?php
            $customers = MySql::connect()->prepare("SELECT * FROM `tb_admin.customers`");
            $customers->execute();
            $customers = $customers->fetchAll();
            foreach($customers as $value){
        ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="top-box">
                    <?php
                        if($value['image'] == ''){
                    ?>
                    <h2><i class="fa fa-user"></i></h2>
                    <?php }else{ ?>
                        <img src="<?php echo INCLUDE_PATH_PANEL ?>uploads/<?php echo $value['image']; ?>" />
                    <?php } ?>
                </div><!--top-box-->
                <div class="body-box">
                    <p><b><i class="fa fa-pencil"></i> Client name: </b> <?php echo $value['name']; ?></p>
                    <p><b><i class="fa fa-pencil"></i> E-mail: </b> <?php echo $value['email']; ?></p>
                    <p><b><i class="fa fa-pencil"></i> Type:</b> <?php echo ucfirst($value['type']); ?></p>
                    <p><b><i class="fa fa-pencil"></i> <?php    
                        if($value['type'] == 'private-individual')
                            echo 'CPF: ';
                        else
                            echo 'CNPJ: ';
                    ?>:</b> <?php echo $value['cpf_cnpj']; ?></p>
                    <div class="group-btn">
                        <a class="btn delete" item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PANEL ?>"><i class="fa fa-times"></i> Excluir</a>
                        <a class="btn edit" href="<?php echo INCLUDE_PATH_PANEL ?>edit-news?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Edit</a>
                    </div><!--group-btn-->
                </div><!--body-box-->
            </div><!--box-single-->
        </div><!--box-single-wraper-->

        <?php } ?>

        <div class="clear"></div>

    </div><!--boxes-->

</div><!--box-content-->