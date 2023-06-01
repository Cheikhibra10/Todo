<?php
$arrayError = [];

if (isset($_SESSION["arrayError"])) {
    $arrayError = $_SESSION["arrayError"];
    unset($_SESSION["arrayError"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Document</title>
</head>
<body>
  <style>
  <?php include "css/register.css" ?>
 </style>
  <div class="container">
    <div class="box">
      <div class="cover"></div>
    <div class="shadow"></div>
    <div class="content">
   <form action="<?php echo WEB_ROUTE ?>" method="post" class="form">
   <input type="hidden" name="controller" value="securityController">
   <input type="hidden" name="action" value="register">
        <h3 class="logo"><i class="fa-solid fa-key"></i></h3>
        <h2>INSCRIPTION</h2>
        <div class="input-box">
          <input type="text" name="prenomU" required>
          <i class="fa-solid fa-user"></i>
          <span>Prenom</span>
        </div>
        <div class="input-box">
          <input type="text" name="nomU" required>
          <i class="fa-solid fa-user"></i>
          <span>Nom</span>
        </div>
        <div class="input-box">
          <input type="text" name="emailU" required>
          <i class="fa-solid fa-user"></i>
          <span>Email</span>
        </div>
         <div class="input-box">
          <input type="password" name="passwordU" required>
          <i class="fa-solid fa-lock"></i>
          <span>Password</span>
        </div>
         <div class="input-box">
          <input type="submit" value="Connecter" required>
        </div>
        <p>Deja un compte?<a href="<?php echo WEB_ROUTE."?controller=securityController&view=login"?>">Connectez-vous</a></p>
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>