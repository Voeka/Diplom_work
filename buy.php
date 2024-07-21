<?php
require('db.php');


// print_r($_SESSION);

// unset($_SESSION['user']);

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_POST['buy'])){
  $id = $_SESSION['user']['id'];
  $datetoday = date('Y-m-d');
  $nextmonth = date('y-0').(string)((int)date('m')+1).(date('-d'));
  $status = 'Оплачено';
  $type = 'Единаразовый';

  $db->query("INSERT INTO `Subs` (`id`, `userid`, `dateduy`, `dateend`, `status`, `type`) VALUES (NULL, '$id', '$datetoday', '$nextmonth', '$status', '$type')");
  echo('<script>alert("Вы успешно оформили подписку на месяц !"); location.href = "user.php"</script>');
  
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

            <div>
                <h2>Оформление подписки</h2>
                <form action="" method="post">
                    <!-- <label for="">Почта: <input type="email" name="email" required placeholder="Ваша Почта" id=""></label><br><br> -->
                    <label for="">Согласие на обработку данных <input type="checkbox" name="check"  required ></label><br><br>
                    <input type="submit" class="btn btn-primary" name='buy' value="Оплатить">
                </form>
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