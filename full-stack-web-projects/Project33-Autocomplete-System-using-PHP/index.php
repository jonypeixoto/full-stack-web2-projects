<?php
    $arr = ['cybertimeup is good', 'cybertimeup training', 'cybertimeup web engineering'];
    if(isset($_POST['action'])){
        $text = $_POST['text'];
        $finalArr = [];
        foreach ($arr as $key => $value) {
            if(preg_match('/'.$text.'/', $value)){
                $finalValue = preg_replace('/'.$text.'/', '<b>$0</b>', $value);
                $finalArr[] = $finalValue;
            }
        }
        print_r($finalArr);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="text" id="">
        <input type="submit" value="Send" name="action">
    </form>
</body>
</html>