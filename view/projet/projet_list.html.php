<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/projet.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<div class="col-md-12 col-sm-12">
    <a href="<?= WEB_ROUTE . "?controller=projetController&view=projet_add" ?>" class="btn5">Ajouter projet</a>
</div>

<div class="creer">
    <h1>Listes projets</h1>
    <div class="rechercher">
 <form action="<?= WEB_ROUTE ?>" method="get">
<input type="hidden" name="controller" value="projetController">
<input type="hidden" name="view" value="filtrer">
<input type="text" name="recherche" class="butt" placeholder="Rechercher par nom...">
<button class="butte" name="OK">OK</button>
</form> 
</div> 
    <table>
        <thead>
            <tr>
                <th>idP</th>
                <th>Nom du projet</th>
                <th>Description du projet</th>
                <th>idU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projetlist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idP"] ?></td>
                    <td><?= $value["nomP"] ?></td>
                    <td><?= $value["descriptionP"] ?></td>
                    <td><?= $value["idU"] ?></td>
                    <td>
                    <a href="<?= WEB_ROUTE . '/?controller=categorieController&view=categorie_add&idP=' . $value['idP'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-plus"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=projetController&view=edit&idP=' . $value['idP'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=projetController&view=delet&idP=' . $value['idP'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                        <a href="<?= WEB_ROUTE . '/?controller=projetController&view=archive&idP=' . $value['idP'] ?>"><i class=" fas fa-archive"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=projetController&view=projet_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>