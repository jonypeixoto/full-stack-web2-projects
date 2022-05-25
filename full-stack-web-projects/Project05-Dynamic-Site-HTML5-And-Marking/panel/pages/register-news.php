<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Register News</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
            if(isset($_POST['action'])){
                $category_id = $_POST['category_id'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $cover = $_FILES['cover'];

                if($title == '' || $content == ''){
                    Panel::alert('error','Empty fields are not allowed!');
                }else if($cover['tmp_name'] == ''){
                    Panel::alert('error','The cover image must be selected.');
                }else{
                    if(Panel::validImage($cover)){
                        $verify = MySql::connect()->prepare("SELECT * FROM `tb_site.news` WHERE title=? AND category_id = ?");
                        $verify->execute(array($title,$category_id));
                        if($verify->rowCount() == 0){
                        $image = Panel::uploadFile($cover);
                        $slug = Panel::generateSlug($title);
                        $arr = ['category_id'=>$category_id,'date'=>date('Y-m-d'),'title'=>$title,'content'=>$content,'cover'=>$image,'slug'=>$slug,
                        'order_id'=>'0',
                        'name_table'=>'tb_site.news'
                        ];
                        if(Panel::insert($arr)){
                            Panel::redirect(INCLUDE_PATH_PANEL.'register-news?success');
                        }

                            //Panel::alert('success','The registration of the news was successful!');
                        }else{
                            Panel::alert('error','There is already a news with that name!');
                        }
                    }else{
                        Panel::alert('error','Select a valid image!');
                    }
                }
            }  
            if(isset($_GET['success']) && !isset($_POST['action'])){
                Panel::alert('success','Registration was successful!');
            }
        ?>
        <div class="form-group">
        <label>Category:</label>
        <select name="category_id">
            <?php  
                $categories = Panel::selectAll('tb_site.categories');
                foreach ($categories as $key => $value) {
            ?> 
            <option <?php if($value['id'] == @$_POST['category_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
            <?php } ?>
        </select>
        </div><!--form-group-->

        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" value="<?php recoverPost('title'); ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Content</label>
            <textarea class="tinymce" name="content"><?php recoverPost('content'); ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="cover"/>
        </div><!--form-group-->

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="name_table" value="tb_site.news" />
            <input type="submit" name="action" value="Register!"/>
        </div><!--form-group-->

    </form>

</div><!--box-content-->