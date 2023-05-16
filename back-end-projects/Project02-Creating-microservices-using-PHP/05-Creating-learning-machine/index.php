<?php
    session_start();
    $_SESSION['questions'][] = "How much does the course cost?";
    $_SESSION['questions'][] = "Can I split it up?";

    $_SESSION['answers'][] = "US$49,99";
    $_SESSION['answers'][] = "Yes!";

    if(isset($_POST['action'])){
        $question = $_POST['question'];
        foreach ($_SESSION['questions'] as $key => $value) {
            $question = str_replace('?', '',$question);
            $question = str_replace(' ', '', $question);
            $value = str_replace(' ', '', $value);
            $test = preg_match('/'.$question.'/i', $value);
            if($test){
                $answer = $_SESSION['answers'][$key];
                break;
            }
        }
    }else if(isset($_POST['register_answer'])){
        $_SESSION['questions'][] = $_POST['question'];
        $_SESSION['answers'][] = $_POST['answer'];
        echo '<script>alert("Thank you, you helped me learn a little more :)")</script>';
    }
?>

<form method="post">
    <h2>Enter your question:</h2>
    <input type="text" name="question" />
    <input type="submit" name="action" value="Send!">
    <?php  
        if(isset($answer)){
            echo '<h2>Your answer based on the question is probably: </h2>'.$answer;
        }else if(isset($_POST['action'])){
            echo '<h2>Oops... Our Robot did not understand your question :(</h2>';
            $createAnswer = true;
        }
    ?>
</form>

<?php 
    if(isset($createAnswer) && isset($_POST['action'])){

?>
    <form method="post">
        <h2>Do you have any idea of the answer, to help the robot learn more?</h2>
        <input type="text" name="answer" />
        <input type="hidden" name="question" value="<?php echo $_POST['question'] ?>">
        <input type="submit" name="register_answer" />
    </form>
<?php
    }
?>
