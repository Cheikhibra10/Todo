<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/categorie.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">



<div class="creer">
    <h1>Listes categories</h1>
    
    <table>
        <thead>
            <tr>
                <th>idC</th>
                <th>Categorie de taches</th>
                <th>idP</th>
                <th>idU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorielist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idC"] ?></td>
                    <td><?= $value["libelleC"] ?></td>
                    <td><?= $value["idP"] ?></td>
                    <td><?= $value["idU"] ?></td>
                    <td>
                    <a href="<?= WEB_ROUTE . '/?controller=tacheController&view=tache_add&idC=' . $value['idC'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-plus"></i></a>      
                        <a href="<?= WEB_ROUTE . '/?controller=categorieController&view=edit&idC=' . $value['idC'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=categorieController&view=delet&idC=' . $value['idC'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                        <a href="<?= WEB_ROUTE . '/?controller=categorieController&view=archive&idC=' . $value['idC'] ?>"><i class=" fas fa-archive"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrePage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=categorieController&view=categorie_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>