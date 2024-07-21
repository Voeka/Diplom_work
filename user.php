<?php
require('db.php');

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_POST['changeinfo'])){
  $login = $_POST['login'];
  $email = $_POST['email'];
  $id = $_SESSION['user']['id'];

  $db->query("UPDATE `users` SET `login` = '$login', `email` = '$email' WHERE `users`.`id` = '$id'");
  $_SESSION['user']['login'] = $login;
  $_SESSION['user']['email'] = $email;
  echo('<script>alert("Вы успешно сменили данные!"); location.href = "user.php"</script>');
}

if(isset($_POST['checkrev'])){
  if(!empty($_POST['anonim'])){
    $name = "Анонимно";
  }else{
    $name = $_SESSION['user']['login'];
  }
  $iduser= $_SESSION['user']['id'];
  $message = $_POST['text'];

  $db->query("INSERT INTO `review` (`id`, `iduser`, `name`, `reviews`) VALUES (NULL, '$iduser', '$name', '$message') ");
  echo('<script>alert("Вы успешно отправили отзыв!"); location.href = "user.php"</script>');
}


$id = $_SESSION['user']['id'];
$Subs = $db->query("SELECT * FROM `Subs` where `userid`='$id'")->fetchAll();





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
      <h1>Личный кабинет</h1>
      <h2>Добро пожаловать, <?php print_r($_SESSION['user']['login']) ?></h2>
      <form action="" method="post">
        <!-- <input type="tel" name="tel" required value="" id=""><br><br> -->
        <input type="text" name="login" required value="<?php print_r($_SESSION['user']['login']) ?>" id=""><br><br>
        <input type="email" name="email" required value="<?php print_r($_SESSION['user']['email']) ?>" id=""><br><br>
        <label>Согласие со сменной данных: <input type="checkbox" required name="check" id=""></label><br><br>
        <input type="submit" name='changeinfo' value="Сменить данные">

      </form>
      <hr>
      <h2>Начать новый курс</h2>
      <a class='btn btn-primary' href="selectlang.php">Курсы</a>
      <hr>
      <h2>Подписки</h2>
      <div class="yLine">
        
      <?php foreach($Subs as $Sub){ ?>
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Дата окончания: <br> <?php print_r($Sub['dateend']) ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Дата подписки: <br> <?php print_r($Sub['dateduy']) ?></h6>
            <p class="card-text">Статус: <?php print_r($Sub['status']) ?></p>
          </div>
        </div>
      <?php } ?>


      </div>

      <a href="buy.php" class="btn btn-primary ">Купить подписку</a>
      <hr>

      <a href="techsupp.php" class="btn btn-warning ">Написать в тех поддрежку</a>
      <p>Результат вашего обращения будет отправлен вам на почту.</p>
      <hr>
        <h2>Оставить отзыв</h2>
        <form method="post">
          <textarea required name="text" cols='50' rows='5' id=""></textarea><br>
          <label for="">Отправить анонимно <input type="checkbox" name="anonim"></label><br>
          <label for="">Согласие на отправку <input type="checkbox" required name="checkrev"></label><br>
          <input class='btn btn-primary' type="submit" value="Отправить отзыв">
        </form>
      <hr>
      <a class="btn btn-primary " href="index.php?wannaINDEX=1">На главную страницу сайта</a>

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