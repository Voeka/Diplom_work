<?php
require('db.php');


// print_r($_SESSION);

// unset($_SESSION['user']);

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_POST['support'])){
  $select = $_POST['select'];
  $message = $_POST['message'];
  $id = $_SESSION['user']['id'];
  $status = 'В обработке';
  $description = '';

  $db->query("INSERT INTO `support` (`id`, `iduser`, `selected`, `message`, `status`, `description`) VALUES (NULL, '$id', '$select', '$message', '$status', '$description')");
  echo('<script>alert("Вы успешно отправили сообщение!"); location.href = "user.php"</script>');
}







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
        <h1>Сообщение в тех поддержку</h1>
        <form action="" method="post">
            <select required  name="select" id="">
                <option value="Проблема с платформой">Проблема с платформой</option>
                <option value="Проблема с подпиской">Проблема с подпиской</option>
                <option value="Проблема с сайтом">Проблема с сайтом</option>
                <option value="Другое">Другое</option>
            </select><br><br>

            <textarea required name="message" id="" cols="30" rows="10"></textarea><br><br>
            <label for="">Согласие на обработку данных: <input type="checkbox" required name="checkbox" id=""></label><br><br>
            <input type="submit" name='support' value="Отправить сообщение">
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