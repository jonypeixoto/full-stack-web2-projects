<?php
    session_start();
    $questions = ['What is your name?','How old are you?','What is your favorite color?','What is your best friend?'];

    if(!isset($_SESSION['answers']))
        $_SESSION['answers'] = array();

    if(isset($_POST['count'])){
        $_SESSION['answers'][$_POST['count']] = $_POST['answer'];
        if(count($questions) == $_POST['count'] + 1){
            header('Location: result.php');
        }
    }

    $index = isset($_POST['count']) ? (int)$_POST['count'] + 1 : 0;
?>

<form method="post">
    <h2><?php echo $questions[$index] ?></h2>
    <input type="text" name="answer" style="width: 100%;height: 20px;">
    <br />
    <input type="submit" name="action" value="Submit Reply and Go to Next Question!" >
    <input type="hidden" name="count" value="<?php echo $index; ?>">
</form>
