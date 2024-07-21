<?php
require('db.php');

// $_SESSION['user'] = 1;
// print_r($_SESSION);

// unset($_SESSION['user']);

unset($_SESSION['lessonStart']);
unset($_SESSION['questions']);
unset($_SESSION['thislesson']);

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_GET['new_user_lang'])){
  $lang = $_GET['new_user_lang'];
  $id = $_SESSION['user']['id'];
  // print_r($lang);
  $db->query("INSERT INTO `learner` (`id`, `iduser`, `idlang`) VALUES (NULL, '$id', '$lang')");
  $_SESSION['lang'] = $lang;
  echo('<script>alert("Вы успешно записались на курс!"); location.href = "selectlesson.php"</script>');
}

if(isset($_GET['continiu_lang'])){
  $_SESSION['lang'] = $_GET['continiu_lang'];
  echo('<script>location.href = "selectlesson.php"</script>');
}

if(isset($_SESSION['lang'])){
  $lang = $_SESSION['lang'];
  $id = $_SESSION['user']['id'];
  $lessons = $db->query("SELECT * FROM `lessons` where `langid` = '$lang' and `types` = 'Открытый'")->fetchAll();
  

  
  // print_r($progress);
  // print_r($lessons);
}


// print_r($reviews);


?>

<!--  -->
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
        <div>

      <?php if(empty($lessons)){ ?>
        <h2>Временно тут ничего нет. Не грустите. Сайт только набирает обороты!</h2>
      <?php }else{ foreach($lessons as $key=>$lesson){ 
        // print_r($key);
        $idlesson = $lesson['id'];
        $progress[$key] = $db->query("SELECT * FROM `progress` where `iduser` = '$id' and `idlesson` = '$idlesson'")->fetch();
        // print_r($progress[$key]);
        ?>
        
        <div>
            <a class="lessan" href="lessom.php?idlesson=<?php print_r($lesson['id']); ?>"> 
                <!-- ?lang=eng;les=id -->
                <h2><?php print_r($lesson['name']) ?></h2>
                <img class="acces" src="
                <?php if(!empty($progress[$key])){ ?>
                img/Complite.png
                <?php }else{ ?>
                img/Avalible.png
                <?php } ?>
                " alt="" width="2rem" height="2rem">
            </a>
        </div>
        <?php } }?>



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