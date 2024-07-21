<?php
require('db.php');

if(isset($_POST['regin'])){
  $email = $_POST['email'];
  $login = $_POST['login'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  if($password!==$password2){
    echo('<script>alert("Вы ошиблись во втором пароле!") </script>');
  }else{
    $db->query("INSERT INTO `users` (`id`, `login`, `email`, `password`, `role`) VALUES (NULL, '$login', '$email', '$password', 'user')");
    
    $user = $db->query("SELECT * from users where `login`= '$login'")->fetch();
    // print_r($user);
    $_SESSION['user']= $user;
    echo('<script>alert("Вы успешно создали аккаунт!"); location.href = "index.php"</script>');
  }

}

if(isset($_GET['loginn'])){
  $login = $_GET['login'];
  $password = $_GET['password'];

  $user = $db->query("SELECT * from users where `login` = '$login' and `password` = '$password'")->fetch();
  if(empty($user)){
    echo('<script>alert("Вы ошиблись при вводе логина/пароля!") </script>');
  }else{
    $_SESSION['user'] = $user;
    echo('<script>alert("Вы успешно вошли в аккаунт!"); location.href = "index.php"</script>');
  }

}

if(isset($_SESSION['user'])){
  echo('<script> location.href = "userlang.php"</script>');
}


// $reviews = $db->query("SELECT * from review")->fetchAll();

// print_r($reviews);

// $_SESSION['user'] = 1;
// print_r($_SESSION);

// unset($_SESSION['user']);

// if(isset($_GET['logout'])){
//   unset($_SESSION['user']);
//   echo('<script>alert("Вы успешно вышли!"); location.href = "index.php"</script>');
// }

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

          <?php if(empty($_SESSION['user'])){

           ?>
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

        <div class="authh">
            <div>
                <h2>Зарегестрироваться</h2>
                <form action="" method="post">
                    <label for="">Почта: <input type="email" name="email" required placeholder="Ваша Почта" id=""></label>
                    <label for="">Логин: <input type="text" name="login" minlength="4" required placeholder="Ваш Логин" id=""></label>
                    <label for="">Пароль: <input type="password" minlength="4" name="password" required placeholder="Придумайте Пароль" id=""></label>
                    <label for="">Павторите пароль: <input type="password" name="password2" minlength="4" required placeholder="Павторите пароль" id="password2"></label>
                    <label for="">Согласие на обработку данных <input type="checkbox" name="check"  required ></label>
                    <input type="submit" class="btn btn-primary" name='regin' value="Зарегестрироваться">
                </form>

            </div>
            <div>
                <h2>Войти</h2>
                <form action="" method="get">
                    <label for="">Логин: <input type="text" name="login" required placeholder="Ваш Логин" id=""></label>
                    <label for="">Пароль: <input type="password" name="password" required id=""></label><br>
                    <input type="submit" name='loginn' class="btn btn-primary" value="Войти">
                </form>
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
    <script type="text/javascript">
        function setFocus()
        {
             document.getElementById("password2").focus();
        }
        </script>
  </body>
</html>