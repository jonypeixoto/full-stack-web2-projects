<?php
// AIzaSyCsReYUh0u86AUyR18uJww1Z4DjnF7u86U

require('vendor/autoload.php');

$youtube = new Madcoda\Youtube\Youtube(array('key' => 'AIzaSyCsReYUh0u86AUyR18uJww1Z4DjnF7u86U'));

$video = $youtube->getVideoInfo('rie-hPVJ7Sw');
print_r($video);
?>
