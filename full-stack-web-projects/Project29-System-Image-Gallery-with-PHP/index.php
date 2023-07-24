<!DOCTYPE html>
<html>
<head>
    <title>Gallery with PHP</title>
    <style type="text/css">
        img{
            max-width: 500px;
        }
    </style>
</head>
<body>
<?php
    include('Gallery.php');
    $gallery = new Gallery();
?>
<img src="<?php echo $gallery->getCurrentPicture(); ?>" />

<a href="<?php echo $gallery->getNextPictureIndex(); ?>">Next</a>

<a href="<?php echo $gallery->getPrevPictureIndex(); ?>">Prev</a>

</body>
</html>