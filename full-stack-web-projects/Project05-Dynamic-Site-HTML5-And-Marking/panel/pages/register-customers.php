<?php  
    verifyPermissionPage(2);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Register Customers</h2>

    <form class="ajax" action="<?php echo INCLUDE_PATH_PANEL ?>ajax/forms.php" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name">
        </div><!--form-group-->
        <div class="form-group">
            <label>E-mail:</label>
            <input type="text" name="email">
        </div><!--form-group-->

        <div class="form-group">
            <label>Type:</label>
            <select name="type_customer">
                <option value="private-individual">Private individual</option>
                <option value="legal-entity">Legal entity</option>
            </select>
        </div><!--form-group-->

        <div style="display: none;" ref="cpf" class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" />
        </div><!--form-group-->

        <div ref="cnpj" class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" />
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