<?php
require('db.php');

$answer = $_POST['text'];
if($answer == $_SESSION['thislesson']['answer']){
    unset($_SESSION['thislesson']);
}else{
    array_push($_SESSION['questions'], $_SESSION['thislesson']);
    unset($_SESSION['thislesson']);
}

$a = $_GET['idlesson'];
header("Location: lessoq.php?idlesson=$a");


