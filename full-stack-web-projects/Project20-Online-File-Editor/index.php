<?php

    if(isset($_POST['action'])){
        $text = $_POST['text'];
        $file = $_POST['file'];
        file_put_contents($file, $text);
        echo '<script>alert("Saved successfully!")</script>';
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Online File Editor</title>
</head>
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .list-files-single{
        background: #d0d3d8;
        padding: 10px;
        border-bottom: 3px solid #adb0b5;
        color: white;
        cursor: pointer;
    }

    .list-file-single:hover{
        background: #828589;
    }
</style>
<body>
<?php
    $files = scandir('files');
    for($i = 0; $i < count($files); $i++){
        if(is_dir($files[$i]))
            continue;

        $file_extension = explode('.', $files[$i]);
        if(@$file_extension[1] == 'php' || @$file_extension[1] == 'html' || @$file_extension[1] == 'js'){
?>
    <div class="list-file-single">
        <p><a href="?file=<?php echo $files[$i]; ?>"><?php echo $files[$i]; ?></a></p>
    </div><!--list-file-singles-->
<?php
        }
    
    }

    if(isset($_GET['file']) && file_exists('files/'.$_GET['file'])){ 
?>
    <h2><?php echo 'Editting file: '.$_GET['file']; ?></h2>
    <form method="post">
        <textarea name="text" style="width: 500px; height: 500px;"><?php echo file_get_contents('files/'.$_GET['file']) ?></textarea>
        <br />
        <input type="hidden" name="file" value="<?php echo 'files/'.$_GET['file']; ?>">
        <input type="submit" name="action" value="Save!">
    </form>
<?php
    }
?>
</body>
</html>