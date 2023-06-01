<?php
$arrayError = [];

if (isset($_SESSION["error"])) {
 $arrayError = $_SESSION["error"];
 unset($_SESSION["error"]);
}
?>
<!doctype html>
<html lang="en">

<head>
 <title>Title</title>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


 <?php
 require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
 ?>
 <style>
  <?php include "css/add-projet.css" ?>
 </style>
 <div class="link">
  <a href="<?= WEB_ROUTE . "?controller=projetController&view=projet_list" ?>" class="btn5">Listes projets</a>
 </div>

 <div class="container">

  <div class="title">
   <h1>Ajouter un Projet</h1>
  </div>
  <form action="<?= WEB_ROUTE ?>" method="post" class="form" enctype="multipart/form-data">
   <input type="hidden" name="controller" value="projetController">
   <?php if (!isset($projetEdit) || $projetEdit['idP'] == null) : ?>
    <input type="hidden" name="action" value="projet_add">
   <?php endif; ?>
   <?php if (isset($projetEdit) && $projetEdit['idP'] != null) : ?>
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="idP" value="<?= $projetEdit['idP'] ?>">
   <?php endif; ?>
   <div class="col">

   <div class="form-group">
     <label class="form-label" for="">Nom du projet</label>
     <input type="text" class="form-input" name="nomP" value="<?= isset($projetEdit) ? $projetEdit['nomP'] : '' ?>">
     <span><?= isset($arrayError) && isset($arrayError["nomP"]) ? $arrayError["nomP"] : ''; ?></span>
    </div>
    <div class="form-group">
     <label class="form-label" for="">Description du projet</label>
  <textarea name="descriptionP" id="" value="<?= isset($projetEdit) ? $projetEdit['descriptionP'] : '' ?>"><?= isset($projetEdit) ? $projetEdit['descriptionP'] : '' ?></textarea>
     <span><?= isset($arrayError) && isset($arrayError["descriptionP"]) ? $arrayError["descriptionP"] : ''; ?></span>
    </div>
    <div class="form-btn4">
     <button type="submit" name="register" class="btn4">Enregistrer</button>
    </div>
   </div>
  
  </form>
 </div>
<script src="js/script.js"></script>

</body>

</html>
<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>