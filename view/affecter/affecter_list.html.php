<?php
require_once(ROUTE_DIR . "view/inc/menu.inc.html.php");
?>

<style>
    <?php include "css/soustache.css" ?>
</style>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


<div class="creer">
    <h1>Listes transferts</h1>

    <table>
        <thead>
            <tr>
                <th>idT</th>
                <th>idC</th>
                <th>idU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transfertlist as $key => $value) : ?>
                <tr>
                    <td><?= $value["libelleT"] ?></td>
                    <td><?= $value["libelleC"] ?></td>
                    <td><?= $value["idU"] ?></td>
                    <td>
                        <a href="<?= WEB_ROUTE . '/?controller=transfertController&view=edit&idT=' . $value['idT'] ?>" style="margin: 2vh;"><i class=" fa-solid fa-pen-to-square"></i></a>
                        <a href="<?= WEB_ROUTE . '/?controller=transfertController&view=delet&idT=' . $value['idT'] ?>"><i class=" fas fa-solid fa-trash"></i></a> 
                      
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
   <?php for ($i = 1; $i <= $nbrePage; $i++) : ?>
    <li class="page-item"><a class="page-link" href="<?= WEB_ROUTE . '?controller=transfertController&view=transfert_list&page=' . $i ?>">
      <?= $i ?></a></li>
   <?php endfor; ?>
  </ul>
 </nav>
<script src="js/script.js"></script>


<?php require_once(ROUTE_DIR . "view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR . "view/inc/footer.inc.html.php") ?>