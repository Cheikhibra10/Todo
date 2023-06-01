<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/tache.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">



<div class="creer">
    <h1>Listes taches</h1>
    <div class="rechercher">
 <form action="<?= WEB_ROUTE ?>" method="get">
<input type="hidden" name="controller" value="tacheController">
<input type="hidden" name="view" value="filtrer">
<input type="text" name="recherche" class="butt" placeholder="Rechercher par nom...">
<button class="butte" name="OK">OK</button>
</form> 
</div> 
    <table>
        <thead>
            <tr>
                <th>idT</th>
                <th>Libelle de tache</th>
                <th>Description de tache</th>
                <th>Categorie de tache</th>
                <th>Date ouvert</th>
                <th>Date Fin</th>
                <th>idU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tachelist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idT"] ?></td>
                    <td><?= $value["libelleT"] ?></td>
                    <td><?= $value["descriptionT"] ?></td>
                    <td><?= $value["idC"] ?></td>
                    <td><?= $value["dated"] ?></td>
                    <td><?= $value["datef"] ?></td>
                    <td><?= $value["idU"] ?></td>
                    <td>
                    <a href="<?= WEB_ROUTE . '/?controller=soustacheController&view=soustache_add&idT=' . $value['idT'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-plus"></i></a>
                    <a href="<?= WEB_ROUTE . '/?controller=transfertController&view=transfert_add&idT=' . $value['idT'] ?>" style="margin: 2vh;color:orange"><i class=" fas fa-share-nodes"></i></a>
                    <a href="<?= WEB_ROUTE . '/?controller=affecterController&view=affecter_add&idT=' . $value['idT'] ?>" style="margin: 2vh;"><i class="fas fa-send"></i></a>
                    <a href="<?= WEB_ROUTE . '/?controller=tacheController&view=edit&idT=' . $value['idT'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                    <a href="<?= WEB_ROUTE . '/?controller=tacheController&view=delet&idT=' . $value['idT'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                    <a href="<?= WEB_ROUTE . '/?controller=tacheController&view=archive&idT=' . $value['idT'] ?>"><i class=" fas fa-archive"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrePage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=tacheController&view=tache_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>