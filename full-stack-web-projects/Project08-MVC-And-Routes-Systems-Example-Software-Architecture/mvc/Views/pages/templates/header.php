<!DOCTYPE html>
<html>
<head>
    <meta charset="uft-8">
    <title><?php echo self::title; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_FULL ?>css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <div class="center">
        <div class="logo">
            <h2>CybertimeUP</h2>
        </div><!--logo-->
        <nav class="menu">
            <?php 
                foreach ($this->menuItems as $key => $value) {
                    echo '<a href="'.INCLUDE_PATH.strtolower($value).'">'.$value.'</a>';
                }
            ?>
        </nav><!--menu-->
        <div class="clear"></div>
    </div><!--center-->
</header>