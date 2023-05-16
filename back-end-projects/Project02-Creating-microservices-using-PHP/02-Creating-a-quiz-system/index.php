<?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=test','root','');
?>

<h2>Online Quiz: </h2>

<hr>
<?php

    if(isset($_POST['action'])){

        if(!isset($_COOKIE['vote'])){
        if(!isset($_POST['answer_id'])){
            header('Location: index.php');
            die();
        }
        setCookie('vote','true',time() + 60 * 60 * 24,'/');
        $answer_id = $_POST['answer_id'];

        $countAnswers = $pdo->prepare("SELECT votes FROM quiz WHERE id = ?");
        $countAnswers->execute(array($answer_id));

        $currentCount = $countAnswers->fetch()['votes'] + 1;

        $pdo->exec("UPDATE quiz SET votes = $currentCount WHERE id = $answer_id");

        echo '<h2>Your vote was successfully tallied!</h2>';
        }else{
            echo '<h2>You have already voted!</h2>';
        }
    }

    $sql = $pdo->prepare("SELECT * FROM question_quiz");
    $sql->execute();
    $questions_quiz = $sql->fetchAll();
    foreach ($questions_quiz as $key => $value) {
        echo '<form method="post">';
        echo '<b>'.$value['question'].'</b>';
        $sql2 = $pdo->prepare("SELECT * FROM quiz WHERE quiz_id = $value[id]");
        $sql2->execute();
        $answers = $sql2->fetchAll();
        echo '<br />';
        foreach ($answers as $key2 => $answer) {
            echo $answer['answers']. '<input type="radio" name="answer_id" value="'.$answer['id'].'" />';
            echo '<br />';
        }
        echo '<input type="submit" name="action" value="Send answer!" />'; 
        echo '</form>';
        echo '<hr>';
    }
?>
