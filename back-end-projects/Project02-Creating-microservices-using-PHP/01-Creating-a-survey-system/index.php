<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
</head>
<body>

<?php
    if(isset($_POST['action'])){
        $answers = array('25','jony','programming');
        $punctuation = 0;
        $index = 0;
        foreach ($_POST as $key => $value) {
            if($key != 'action'){
                if($answers[$index] == $value){
                    $punctuation++;
                }
                $index++;
            }
            
        }
        echo '<h2>Your final result was: </h2>'.$punctuation.'/'.($index);
    }
?>

<form method="post">
    <p>How old are you?</p>
    <span>25</span><input type="radio" name="question1" value="25">
    <br />
    <span>30</span><input type="radio" name="question1" value="30">
    <br />
    <span>40</span><input type="radio" name="question1" value="40">
    <hr />
    <p>What is your name?</p>
    <span>Jony</span><input type="radio" name="question2" value="jony">
    <br />
    <span>Jeff</span><input type="radio" name="question2" value="jeff">
    <br />
    <span>Jenny</span><input type="radio" name="question2" value="jenny">
    <hr />
    <p>What do you like do?</p>
    <span>Sports</span><input type="radio" name="question3" value="sports">
    <br />
    <span>Programming</span><input type="radio" name="question3" value="programming">
    <br />
    <span>Eat</span><input type="radio" name="question3" value="eat">
    <hr />
    <input type="submit" name="action" value="Send!">
</form>

</body>
</html>
