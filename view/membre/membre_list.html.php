<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/projet.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<div class="col-md-12 col-sm-12">
    <a href="<?= WEB_ROUTE . "?controller=membreController&view=membre_add" ?>" class="btn5">Ajouter un membre</a>
</div>

<div class="creer">
    <h1>Listes membres</h1>
    <div class="rechercher">
 <form action="<?= WEB_ROUTE ?>" method="get">
<input type="hidden" name="controller" value="membreController">
<input type="hidden" name="view" value="filtrer">
<input type="text" name="recherche" class="butt" placeholder="Rechercher par membre...">
<button class="butte" name="OK">OK</button>
</form> 
</div> 
    <table>
        <thead>
            <tr>
                <th>idUE</th>
                <th>Nom de membre</th>
                <th>Nom du L'membre</th>
                <th>Tache a faire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($membrelist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idUE"] ?></td>
                    <td><?= $value["prenomU"]. " ".$value["nomU"]?></td>
                    <td><?= $value["nomE"] ?></td>
                    <td><?= $value["libelleT"] ?></td>
                    <td>
                        <a href="<?= WEB_ROUTE . '/?controller=membreController&view=enlever&idUE=' . $value['idUE'] ?>" class="enlever"><i class=" fa-solid fa-close"></i></a> 
                        <a href="<?= WEB_ROUTE . '/?controller=rappelController&view=rappel_add&idUE=' . $value['idUE'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-plus"></i></a> 
                        <a href="<?= WEB_ROUTE . '/?controller=membreController&view=edit&idUE=' . $value['idUE'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=membreController&view=delet&idUE=' . $value['idUE'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                        <a href="<?= WEB_ROUTE . '/?controller=membreController&view=archive&idUE=' . $value['idUE'] ?>"><i class=" fas fa-archive"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=membreController&view=membre_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>