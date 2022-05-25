<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Add Service</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                
                if(Panel::insert($_POST)){
                    Panel::alert('success','The registration of the service was successful!');
                }else{
                    Panel::alert('error','Empty fields are not allowed!');
                }
            }   
        ?>

        <div class="form-group">
            <label>Describe the service:</label>
            <textarea name="service"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="name_table" value="tb_site.services" />
            <input type="submit" name="action" value="Register!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->