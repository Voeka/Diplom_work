<?php
require('db.php');


$_SESSION['teacher'] = 1;

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

 if((!$_SESSION['user']['role']=='teacher') or (!$_SESSION['user']['role']=='admin')){ 
    echo('<script>alert("Вам сюда нельзя!"); location.href = "index.php"</script>');
 }


$id = $_SESSION['user']['id'];



$langs = $db->query("SELECT * FROM `lang` where `creatorid`='$id'")->fetchAll();

$alllessons = $db->query("SELECT * FROM `lessons` where `creatorid`='$id'")->fetchAll();



// print_r($lessons);
// print_r($_SESSION);

// unset($_SESSION['user']);

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
      <h1>Учительская зона</h1>
      <hr>
      <h2>Работа с занятиями(уроками) по языкам</h2>
      <div class='langsss'>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <?php foreach($langs as $key=>$lang){ ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php print_r($key); ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                <?php print_r($lang['name']) ?> <br>
                <?php print_r($lang['creator']) ?> <br>
                Открыт: <?php print_r($lang['open']) ?>
              </button>
            </h2>
            <div id="flush-collapse<?php print_r($key); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">

              <div class="accordion-body">
                <?php 
                $langid = $lang['id'];
                $lessons = $db->query("SELECT * from `lessons` where `langid` = '$langid'")->fetchAll();
                
                foreach($lessons as $lesson){ ?>
                  <a class="btn btn-primary " href="changelesson.php?idlesson=<?php print_r($lesson['id']) ?>"><?php print_r($lesson['name']) ?></a>  <br><br>

                <?php } ?>
                <a class="btn btn-danger " href="createlesson.php?create=<?php print_r($lang['id']); ?>">Создать занятие</a>  <br><br>
              </div>
            
            </div>
          </div>
          <?php } ?>

          
        </div>

      </div>

      <br><a class="btn btn-success " href="createlang.php?create=1">Создать новое направление(язык, предмет)</a>
      <hr>
      <h2>Работа с вопросами по урокам</h2>
      <div class='langsss'>
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <?php foreach($alllessons as $key=>$lesson){ ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseT<?php print_r($key); ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                <?php print_r($lesson['name']) ?> <br>
                <?php print_r($lesson['author']) ?> <br>
                Открытость <?php print_r($lesson['types']) ?>
              </button>
            </h2>
            <div id="flush-collapseT<?php print_r($key); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">

              <div class="accordion-body">
                <?php 
                $lessonid = $lesson['id'];
                $questions = $db->query("SELECT * from `question` where `lessonID` = '$lessonid'")->fetchAll();
                foreach($questions as $question){ ?>
                  <a class="btn btn-primary " href="changequestion.php?idquestion=<?php print_r($question['id']) ?>"><?php print_r($question['question']) ?></a>  <br><br>

                <?php } ?>
                <a class="btn btn-danger " href="createquestion.php?create=<?php print_r($lessonid); ?>">Создать вопрос к уроку/предмету</a>  <br><br>
              </div>
            
            </div>
          </div>
          <?php } ?>

          
        </div>

      </div>

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