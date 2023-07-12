<?php
    require('vendor/autoload.php');

    $connectionMongo = new MongoDB\Client('mongodb+srv://root:jony123456@cluster0.e5bhsum.mongodb.net/');

    $database = $connectionMongo->cybertimeup;

    $collection = $database->classes;

    //Insert data
    //$collection->insertOne(['name'=>'CybertimeUP Inserted','course'=>'dev web']);

    //Update data
    $collection->updateOne(['name'=>'CybertimeUP Inserted'],['$set'=>['name'=>'CybertimeUP Updated 3']]);

    //Delete data
    //$collection->deleteOne(array('name'=>'CybertimeUP'));

    $data = $collection->find();

    foreach($data as $key=>$value){
        echo $value['name'];
        echo '<br />';
    }



?>