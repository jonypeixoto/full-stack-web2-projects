<?php
    if(isset($_GET['logout'])){
        Panel::logout();
    }
?>
<DOCTYPE html>
<html>
<head>
    <title>Control Panel</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PANEL ?>css/style.css" rel="stylesheet" />
</head>
<body>

<base base = "<?php echo INCLUDE_PATH_PANEL; ?>" /> 
<div class="menu">
    <div class="menu-wraper">
    <div class="box-user">
        <?php
			if($_SESSION['img'] == ''){
		?>
            <div class="avatar-user">
                <i class="fa fa-user"></i>
            </div><!--avatar-user-->
        <?php }else{ ?>
            <div class="image-user">
                <img src="<?php echo INCLUDE_PATH_PANEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
            </div><!--image-user-->
        <?php } ?>
    <div class="name-user">
        <p><?php echo $_SESSION['name']; ?></p>
		<p><?php echo takeOffice($_SESSION['office']); ?></p>
    </div><!--name-user-->
    </div><!--box-user-->
    <div class="items-menu">
        <h2>Register</h2>
        <a <?php echo selectedMenu('register-testimonial'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-testimonial">Register Testimonial</a>
        <a  <?php echo selectedMenu('register-service'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-service">Register Service</a>
        <a  <?php echo selectedMenu('register-slides'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-slides">Register Slides</a>
        <h2>Management</h2>
        <a  <?php echo selectedMenu('list-testimonials'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>list-testimonials">List Testimonials</a>
        <a  <?php echo selectedMenu('list-services'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>list-services">List Services</a>
        <a  <?php echo selectedMenu('list-slides'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>list-slides">List Slides</a>
        <h2>Panel administration</h2>
        <a  <?php echo selectedMenu('edit-user'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>edit-user">Edit User</a>
        <a  <?php echo selectedMenu('add-user'); ?><?php verifyPermissionMenu(2); ?> href="<?php echo INCLUDE_PATH_PANEL ?>add-user">Add User</a>
        <h2>General Configuration</h2>
        <a  <?php echo selectedMenu('edit-site'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>edit-site">Edit Site</a>
        <h2>News Management</h2>
        <a <?php echo selectedMenu('register-categories'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-categories">Register Categories</a>
        <a <?php echo selectedMenu('manage-categories'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>manage-categories">Manage Categories</a>
        <a <?php echo selectedMenu('register-news'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-news">Register News</a>
        <a <?php echo selectedMenu('manage-news'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>manage-news">Manage News</a>
        <h2>Client management</h2>
        <a <?php echo selectedMenu('register-customers'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>register-customers">Register Customers</a>
        <a <?php echo selectedMenu('manage-customers'); ?> href="<?php echo INCLUDE_PATH_PANEL ?>manage-customers">Manage Customers</a>
    </div><!--items-menu-->
    </div><!--menu-wraper-->
</div><!--menu-->   

<header>
    <div class="center">
        <div class="menu-btn">
			<i class="fa fa-bars"></i>
		</div><!--menu-btn-->

        <div class="logout">
			<a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 10px;" <?php } ?> href="<?php echo INCLUDE_PATH_PANEL ?>"> <i class="fa fa-home"></i> <span>Home Page</span></a>
			<a href="<?php echo INCLUDE_PATH_PANEL ?>?logout"> <i class="fa fa-window-close"></i> <span>Logout</span></a>
		</div><!--logout-->

        <div class="clear"></div>
    </div><!--center-->
</header>

<div class="content">

    <?php Panel::loadPage(); ?>
        
</div><!--content-->

<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
<script src="<?php echo INCLUDE_PATH_PANEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PANEL ?>js/jquery.ajaxform.js"></script>
<script src="<?php echo INCLUDE_PATH_PANEL ?>js/constants.js"></script>
<script src="<?php echo INCLUDE_PATH_PANEL ?>js/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({ selector:'.tinymce',
        plugins: 'image',
        height: 300
        });
    </script>
    <script src="<?php echo INCLUDE_PATH_PANEL ?>js/helperMask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PANEL ?>js/ajax.js"></script>
    <?php Panel::loadJS(array('customers.js'),'manage-customers'); ?>
</body>
</html>