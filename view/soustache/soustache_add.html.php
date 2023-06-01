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
  <?php include "css/add-soustache.css" ?>
 </style>
 <div class="link">
  <a href="<?= WEB_ROUTE . "?controller=soustacheController&view=soustache_list" ?>" class="btn5">Listes soustaches</a>
 </div>

 <div class="container">

  <div class="title">
   <h1>Ajouter un soustache</h1>
  </div>
  <form action="<?= WEB_ROUTE ?>" method="post" class="form" enctype="multipart/form-data">
   <input type="hidden" name="controller" value="soustacheController">
   <?php if (!isset($soustacheEdit) || $soustacheEdit['idST'] == null) : ?>
    <input type="hidden" name="action" value="soustache_add">
   <?php endif; ?>
   <?php if (isset($soustacheEdit) && $soustacheEdit['idST'] != null) : ?>
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="idST" value="<?= $soustacheEdit['idST'] ?>">
   <?php endif; ?>
   <div class="col">

   <div class="form-group">
     <label class="form-label" for="">Libelle du soustache</label>
     <input type="text" class="form-input" name="libelleST" value="<?= isset($soustacheEdit) ? $soustacheEdit['libelleST'] : '' ?>">
     <span><?= isset($arrayError) && isset($arrayError["libelleST"]) ? $arrayError["libelleST"] : ''; ?></span>
    </div>
    <div class="form-group">
     <label class="form-label" for="">Nom de la tache</label>
     <input disabled type="text" class="form-input" name="idT" value="<?= ($tacheEdit) ? $tacheEdit['libelleT'] : '' ?>">
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