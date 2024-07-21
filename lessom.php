<?php
require('db.php');

// $_SESSION['user'] = 1;
// print_r($_SESSION);

// unset($_SESSION['user']);

if(isset($_GET['logout'])){
  unset($_SESSION['user']);
  echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
}



if(isset($_SESSION['lang'])){
  $idlesson = $_GET['idlesson'];
  $lesson = $db->query("SELECT * FROM `lessons` where `id` = '$idlesson'")->fetch();
  

  
  // print_r($progress);
  // print_r($lesson);
}


// print_r($reviews);


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
        <div class="lessin">   
            <div class="titlle">
                <h2><a href="selectlesson.php"><img src="img/exit.png" alt=""></a>  Изучение материала - <?php print_r($lesson['heading']); ?></h2>
            </div>
            <div class="material_lesson">
              <!-- ?php if(!empty($lesson['video'])){ ? -->
                <!-- <iframe width="100%" height="742" src="<?php print_r($lesson['video']); ?>" title="ШОКИРУЮЩИЕ РАЗГОВОРЫ МАТАРЫ И КУРО  [VShojo Sub]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
              <!-- ?php } ? -->
                <img class="lessinIMG" src="<?php print_r($lesson['img']); ?>" alt="">
            </div>
            <p>
            <?php print_r($lesson['Descr']); ?>
            </p>

            <a class="btn btn-myorange" href="lessoq.php?idlesson=<?php print_r($lesson['id']); ?>">Дальше</a>

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