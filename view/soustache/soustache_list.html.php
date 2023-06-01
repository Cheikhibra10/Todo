<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/soustache.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">



<div class="creer">
    <h1>Listes soustaches</h1>
  
    <table>
        <thead>
            <tr>
                <th>idST</th>
                <th>Nom du soustache</th>
                <th>idT</th>
                <th>idU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($soustachelist as $key => $value) : ?>
                <tr>
                    <td><?= $value["idST"] ?></td>
                    <td><?= $value["libelleST"] ?></td>
                    <td><?= $value["idT"] ?></td>
                    <td><?= $value["idU"] ?></td>
                    <td>
                        <a href="<?= WEB_ROUTE . '/?controller=soustacheController&view=edit&idST=' . $value['idST'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=soustacheController&view=delet&idST=' . $value['idST'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                      
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