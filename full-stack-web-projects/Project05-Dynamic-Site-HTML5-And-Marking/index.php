<?php include('config.php'); ?>
<?php Site::updateUserOnline(); ?>
<?php Site::counter(); ?>
<?php
    $infoSite = MySql::connect()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<head>
    <title><?php echo $infoSite['title']; ?></title>
    <link href="<?php echo INCLUDE_PATH; ?>css/font-awesome.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="person name or enterprise name" />
    <meta name="keywords" content="keywords,of,my,site">
    <meta name="description" content="Description of my website">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
    <meta charset="utf-8" />
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />

    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        switch ($url) {
            case 'testimonial':
                echo '<target target="testimonial" />';
                break;

            case 'services':
                echo '<target target="services" />';
                break;
        }
    ?>
    <div class="success">Form submitted successfully!</div><!--success-->
    <div class="overlay-loading">
        <img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
    </div><!--overlay-loading-->

    <header>
        <div class="center">
            <div class="logo left"><a href="/">Logo</a></div><!--logo-->
            <nav class="desktop right">
                <ul>
                    <li title="Home"><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li title="Testimonials"><a href="<?php echo INCLUDE_PATH; ?>testimonials">Testimonials</a></li>
                    <li title="Services"><a href="<?php echo INCLUDE_PATH; ?>services">Services</a></li>
                    <li title="News"><a href="<?php echo INCLUDE_PATH; ?>news">News</a></li>
                    <li title="Contact"><a realtime="contact" href="<?php echo INCLUDE_PATH; ?>contact">Contact</a></li>
                    <li title="Other menu"><a realtime="other-menu" href="<?php echo INCLUDE_PATH; ?>other-menu">Other menu</a></li>
                </ul>
            </nav><!--desktop-->
            <nav class="mobile right">
                <div class="button-menu-mobile">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <ul>
                    <li title="Home"><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li title="Testimonials"><a href="<?php echo INCLUDE_PATH; ?>testimonials">Testimonials</a></li>
                    <li title="Services"><a href="<?php echo INCLUDE_PATH; ?>services">Services</a></li>
                    <li title="News"><a href="<?php echo INCLUDE_PATH; ?>news">News</a></li>
					<li title="Contact"><a realtime="contact" href="<?php echo INCLUDE_PATH; ?>contact">Contact</a></li>
                    <li title="Other menu"><a realtime="other-menu" href="<?php echo INCLUDE_PATH; ?>other-menu">Other menu</a></li>
                </ul>
            </nav><!--mobile-->
        <div class="clear"></div><!--clear-->
        </div><!--center-->
    </header>

    <div class="container-principal">
    <?php
    
        if(file_exists('pages/'.$url.'.php')){
            include('pages/'.$url.'.php');
        }else{
            // We can do what we want, because the page exists.
            if($url != 'testimonials' && $url != 'services'){
                $urlPar = explode('/',$url)[0];
                if($urlPar != 'news'){
                $page404 = true;
                include('pages/404.php');
                }else{
                    include('pages/news.php');
                }
            }else{
                include('pages/home.php');     
            }
        }

    ?>

    </div><!--container-principal-->

    <footer <?php if(isset($page404) && $page404 == true) echo 'class="fixed"'; ?>>
        <div class="center">
            <p>Copyright © 2021 CybertimeUP. All Rights Reserved. ®</p>
        </div><!--center-->
    </footer>

    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>

    <script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

    <?php  
        if(is_array($url) && strstr($url[0],'news') !== false){
    ?>
        <script>
            $(function(){
                $('select').change(function(){
                    location.href=include_path+"news/"+$(this).val();
                })
            })
        </script>
    <?php
        }
    ?>

    <?php
        if($url == 'contact'){
    ?>

    <?php } ?>
    <script src="<?php echo INCLUDE_PATH; ?>js/example.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/forms.js"></script>
</body>
</html>
