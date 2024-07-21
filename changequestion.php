<?php
require('db.php');


// print_r($_SESSION);

// unset($_SESSION['user']);
$idquestion = $_GET['idquestion'];
$question = $db->query("SELECT * FROM `question` where `id`='$idquestion'")->fetch();

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

 if((!$_SESSION['user']['role']=='teacher') or (!$_SESSION['user']['role']=='admin')){ 
    echo('<script>alert("Вам сюда нельзя!"); location.href = "index.php"</script>');
 }


if(isset($_POST['change_it'])){

    
    $questionn = $_POST['questionn'];
    $answer = $_POST['answer'];

    $db->query("UPDATE `question` SET `question` = '$questionn', `answer` = '$answer' WHERE `question`.`id` = '$idquestion'");
    // unset($_SESSION['teacher']);
    if(!empty($_SESSION['teacher'])){
      $way = 'teacher.php';
    } else{
      $way = 'admin.php';
    }
    
    echo("<script>alert('Данные изменены!'); location.href = '$way'</script>");
}

    



$id = $_SESSION['user']['id'];




// print_r($_SESSION);


?>


<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Прудик</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/logo.png">
  </head>
  <body>
    <!-- Шапка сайта -->
    <header>
      <a href="index.php" class="headlink"><h1>Прудик</h1></a>
      <?php if(($_SESSION['user']['role']=='teacher') or ($_SESSION['user']['role']=='admin')){ ?>
      <a href="teacher.php" class="headlink"><h1>Для учителей</h1></a>
      <?php }?>
      <?php if($_SESSION['user']['role']=='admin'){ ?>
      <a href="admin.php" class="headlink"><h1>Для админа</h1></a>
      <?php }?>


      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="img/профиль.png" alt="">
        </a>
      
        <ul class="dropdown-menu">
            <?php if(empty($_SESSION['user'])){ ?>
            <li><a class="dropdown-item" href="auth.php">Авторизоваться</a></li>
            <?php } else{  ?>
            <li><a class="dropdown-item" href="user.php">Профиль</a></li>
            <li><a class="dropdown-item" href="?logout">Выйти</a></li>
          <?php } ?>
        </ul>
      </div>
      
    </header>
    <hr class="hr">

    

    <main>
      <h1>Изменение вопроса к уроку(занятию)</h1>
      <hr>
      <form action="" method='post'>
            <label for="">Вопрос <input type="text" name="questionn" value='<?php print_r($question['question']) ?>' id=""></label> <br>
            <label for="">Ответ <input type="text" name="answer" value='<?php print_r($question['answer']) ?>' id=""></label> <br>
            <input class="btn btn-primary "  type="submit" name='change_it' value="Изменить Вопрос">
      </form>
        

    </main>

    <footer>
      <p><b>Свясь с нами</b></p>
      <a href="mailto:help@prudik.ru">help@prudik.ru</a><br>
      <a href="tel:+7 966 085 39 38">+7(000)000 00-00</a>
      <br><br>
      <p><b>Мы в социальных сетях</b></p>
      <div>
        <a href="#"><img src="img/TG.png" alt="Telegramm"></a>
        <a href="#"><img src="img/WAP.png" alt="WhatssApp"></a>
        <a href="#"><img src="img/VK.png" alt="VK"></a>

      </div>

    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>