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
  <?php include "css/add-tache.css" ?>
 </style>
 <div class="link">
  <a href="<?= WEB_ROUTE . "?controller=tacheController&view=tache_list" ?>" class="btn5">Lister taches</a>
 </div>

 <div class="container">

  <div class="title">
   <h1>Ajouter un tache</h1>
  </div>
  <form action="<?= WEB_ROUTE ?>" method="post" class="form" enctype="multipart/form-data">
   <input type="hidden" name="controller" value="tacheController">
   <?php if (!isset($tacheEdit) || $tacheEdit['idT'] == null) : ?>
    <input type="hidden" name="action" value="tache_add">
   <?php endif; ?>
   <?php if (isset($tacheEdit) && $tacheEdit['idT'] != null) : ?>
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="idT" value="<?= $tacheEdit['idT'] ?>">
   <?php endif; ?>
   <div class="col">

    <div class="form-group">
     <label class="form-label" for="">Date d'ouverture</label>
     <input type="Date" class="form-input" name="dated" value="<?= isset($tacheEdit) ? $tacheEdit['dated'] : '' ?>">
     <span><?= isset($arrayError) && isset($arrayError["dated"]) ? $arrayError["dated"] : ''; ?></span>
    </div>
    <div class="form-group">
     <label class="form-label" for="">Libelle Tache</label>
     <input type="text" class="form-input" name="libelleT" value="<?= isset($tacheEdit) ? $tacheEdit['libelleT'] : '' ?>">
     <span><?= isset($arrayError) && isset($arrayError["libelleT"]) ? $arrayError["libelleT "] : ''; ?></span>
    </div>
  
    <div class="form-group">
     <label class="form-label" for="">Description Tache</label>
     <textarea name="descriptionT" id="" value="<?= isset($tacheEdit) ? $tacheEdit['descriptionT'] : '' ?>"><?= isset($tacheEdit) ? $tacheEdit['descriptionT'] : '' ?></textarea>
    </div>
    <div class="form-btn4">
     <button type="submit" name="register" class="btn4">Enregistrer</button>
    </div>  
   </div>
   <div class="col">
     <div class="form-group">
     <label class="form-label" for="">Date de Fin</label>
     <input type="date" class="form-input" name="datef" value="<?= isset($tacheEdit) ? $tacheEdit['datef'] : '' ?>">
     <span><?= isset($arrayError) && isset($arrayError["datef"]) ? $arrayError["datef"] : ''; ?></span>
    </div>
    <div class="form-group">
    <label for="type" class="form-label">Categorie de tache</label>
    <input disabled type="text" class="form-input" name="idC" value="<?= ($categorieEdit) ? $categorieEdit['libelleC'] : '' ?>">
    </div>

   
    
     
   
  
   </div>
   
  </form>
 </div>
<script src="js/script.js"></script>
</body>
</html>
<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>