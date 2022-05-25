<?php  
    verifyPermissionPage(2);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Add Testimonials</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                
                if(Panel::insert($_POST)){
                    Panel::alert('success','The registration of the testimonial was successful!');
                }else{
                    Panel::alert('error','Empty fields are not allowed!');
                }
                
            }   
        ?>

        <div class="form-group">
            <label>Name's person:</label>
            <input type="text" name="name">
        </div><!--form-group-->

        <div class="form-group">
            <label>Testimonial:</label>
            <textarea name="testimonial"></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Date:</label>
            <input format="date" type="text" name="date">
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="name_table" value="tb_site.testimonials" />
            <input type="submit" name="action" value="Register!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->