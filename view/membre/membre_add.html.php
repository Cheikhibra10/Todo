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
 <meta name="viewport" content="widPh=device-widPh, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


 <?php
 require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
 ?>
 <style>
  <?php include "css/add-soustache.css" ?>
 </style>
 <div class="link">
  <a href="<?= WEB_ROUTE . "?controller=membreController&view=membre_list" ?>" class="btn5">Listes membres</a>
 </div>

 <div class="container">

  <div class="title">
   <h1>Ajouter Un membre</h1>
  </div>
  <form action="<?= WEB_ROUTE ?>" method="post" class="form" enctype="multipart/form-data">
   <input type="hidden" name="controller" value="membreController">
   <?php if (!isset($membreEdit) || $membreEdit['idUE'] == null) : ?>
    <input type="hidden" name="action" value="membre_add">
   <?php endif; ?>
   <?php if (isset($membreEdit) && $membreEdit['idUE'] != null) : ?>
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="idUE" value="<?= $membreEdit['idUE'] ?>">
   <?php endif; ?>
   <div class="col">

   
    <div class="form-group">
     <label class="form-label" for="">Nom de L'equipe</label>
     <select class="form-input" name="idE">
       <option value="0">Selectionnez l'equipe</option>
       <?php foreach ($equipes as $equipe) : ?>
        <option value="<?= $equipe["idE"] ?>"><?= $equipe["nomE"] ?></option>
       <?php endforeach;?>
      </select>
    </div>
    <div class="form-groupe">
    <?php foreach ($users as $user) : ?>
      <input type="checkbox" name="idU[]" class="check" value="<?= $user["idU"] ?>">
     <label class="form-label" for="" ><?= $user["prenomU"]. " ".$user["nomU"] ?></label>
     <?php endforeach;?>
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