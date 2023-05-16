<?php
    $request = file_get_contents('https://www.instagram.com/jonypeixoto/?__a=1');
    $object = json_decode($request);
    $images = $object->user->media->nodes;

    for($i = 0; $i < 10; $i++){
        echo '<img src="'.$images[$i]->thumbnail_src.'" />';
    }
?>
