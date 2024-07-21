<?php
require('db.php');

// $_SESSION['user'] = 1;
// print_r($_SESSION);

// unset($_SESSION['user']);

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}

if(isset($_GET['stoplerning'])){
  $stopleringid = $_GET['stoplerning'];
  $db->query("DELETE FROM learner WHERE `learner`.`id` = '$stopleringid'");
  echo('<script>alert("Вы удалили КУРС со своей учётной записи!"); location.href = "userlang.php"</script>');
}
$langs = $_SESSION['user']['id'];
// print_r($langs);

$lang = $db->query("SELECT * from learner where `iduser`='$langs'")->fetchAll();

// print_r($lang);


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
      <h1>Начатые языковые курсы</h1>
      <div class="langueges">

      <?php foreach($lang as $lans1){ 
        
        $lans = $lans1['idlang'];
        $lan = $db->query("SELECT * from lang where `id`='$lans'")->fetch();
        
        ?>
        <div class="card" style="width: 18rem;">
            <img src="<?php print_r($lan['img']); ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"><?php print_r($lan['name']); ?></h5>
              <h6 class="card-subtitle mb-2 text-body-secondary">Автор: <?php print_r($lan['creator']); ?></h6>
              <p class="card-text"><?php print_r($lan['descr']); ?></p>
              <a href="selectlesson.php?continiu_lang=<?php print_r($lan['id']); ?>" class="btn btn-primary">Продолжить изучать</a>
              <br><br><br><br>
              <a class="btn btn-danger" href="?stoplerning=<?php print_r($lans1['id']); ?>">Прекратить изучать этот предмет! Не обратимо!</a>
              <!-- Тут в направление мы делаем php файл, в котором отправляются данные на сервер и переводит пользователя на страницу выбора уроков -->
            </div>
          </div>
        <?php } ?>


          

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