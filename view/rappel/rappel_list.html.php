<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/soustache.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">



<div class="creer">
    <h1>Listes rappels</h1>
  
    <table>
        <thead>
            <tr>
                <th>idRA</th>
                <th>Nom du rappel</th>
                <th>idU</th>
                <th>idT</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rappellist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idRA"] ?></td>
                    <td><?= $value["libelleRA"] ?></td>
                    <td><?= $value["prenomU"]. " ".$value["nomU"]?></td>
                    <td><?= $value["libelleT"] ?></td>
                    <td>
                        <a href="<?= WEB_ROUTE . '/?controller=rappelController&view=edit&idRA=' . $value['idRA'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=rappelController&view=delet&idRA=' . $value['idRA'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                      
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrPage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=soustacheController&view=soustache_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>