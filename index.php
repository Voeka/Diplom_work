<?php
require('db.php');

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_SESSION['user']) and empty($_GET['wannaINDEX'])){
  $iduser = $_SESSION['user']['id'];
  $langs = $db->query("SELECT * from learner where `iduser` = '$iduser'")->fetch();
  if(!empty($langs)){
  $_SESSION['langs'] = $langs;
  echo('<script> location.href = "userlang.php"</script>');

  }else{

  echo('<script> location.href = "selectlang.php"</script>');
  }
}


$reviews = $db->query("SELECT * from review")->fetchAll();

// print_r($reviews);
// $_SESSION['user'] = 1;
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
      <h1>Прудик - Обучающая платформа по изучению языков</h1>
      <h2>Просто и эффективно</h2>
      <p>Прудик - это веб-платформа для онлайн-изучения иностранных языков</p>
      <p>Мы предлагаем уникальные возможности для всех, кто хочет освоить новый язык удобно и эффективно.</p>

      <p>Наши курсы разработаны профессиональными преподавателями и языковыми экспертами, чтобы предоставить студентам полное погружение в изучаемый язык. Структурированные уроки, интерактивные задания и живое общение с преподавателями делают процесс обучения увлекательным и эффективным.</p>

      <h2>Основные функции</h2>
      <!-- Слайдер bootstrap -->
      <div class="slider">
        <div id="carouselExampleCaptions" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/lern.png" class="d-block w-70" alt="lern">
              <div class="carousel-caption d-none d-md-block">
                <h5>Стать учеником на нашей платформе</h5>
                <p>Наша плаформа позволяет всем желающим учить языки по открытым курсам. </p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/teacher.png" class="d-block w-70" alt="teacher">
              <div class="carousel-caption d-none d-md-block">
                <h5>Стать преподавателем языка на нашей платформе</h5>
                <p>Наша плаформа позволяет создавать свои курсы. Открытые и закрытые курсы. Мы не ограничиваем преподавателей в их работе, мы помогаем им для более удобного взаимодействия с учениками.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/learn.png" class="d-block w-70" alt="learn">
              <div class="carousel-caption d-none d-md-block">
                <h5>Работайте напрямую с учителями</h5>
                <p>При оформлении подписки у вас появляется возможность брать личные и групповые уроки у преподавателей. Чаще всего вы договариваетесь с ними, и в частном случае они с вами работают.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>



      </div>

      <h2>Присоединяйтесь к Прудик прямо сейчас и откройте для себя новые возможности в мире языкового обучения</h2>

      <a href="auth.php" class="btn btn-warning"> Присоединится</a> <br>

      <h2>Отзывы</h2>
      <!-- Отзывы -->
      <div class="comment">

            <?php if(empty($reviews)){ ?>
          <p>Их пока нет, будь первым! В личном кабинете.</p>
          <?php }else{ ?>
<!-- Уже сделал стили, всё ок. Надо добыть фидбек от друзей, перед показами. -->
        <?php foreach($reviews as $review){ ?>
        <div class="card">
          <h5 class="card-header"><?php print_r($review['name']) ?></h5>
          <div class="card-body">

            <p class="card-text"><?php print_r($review['reviews']) ?></p>
          </div>
        </div>

       <?php } } ?>

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