<?php
require_once(ROUTE_DIR . "view/inc/header.inc.html.php");
?>
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<header class="header" id="header">
   

<a href="<?= WEB_ROUTE . "?controller=projetController&view=projet_list" ?>" class="nav_link">
                    <i class='fas fa-folder-open nav_icon'></i>
                    <span class="nav_name">Project</span>
                </a>
               
               
                <a href="<?= WEB_ROUTE . "?controller=categorieController&view=categorie_list" ?>" class="nav_link">
                    <i class='fas fa-palette nav_icon'></i>
                    <span class="nav_name">Categorie de Taches</span>
                </a>
                <ul>
               <li>
               <a href="<?= WEB_ROUTE . "?controller=tacheController&view=tache_list" ?>">
                    <i class='fa fa-tasks nav_icon'></i>
                    <span class="nav_name">Taches</span>
                </a>
            <ul class="dropdown">
            <li><a href="<?= WEB_ROUTE . "?controller=soustacheController&view=soustache_list" ?>">Sous-Tache</a>
        </li>
            <li><a href="<?= WEB_ROUTE . "?controller=transfertController&view=transfert_list" ?>">Transfert</a></li>       
            <li><a href="<?= WEB_ROUTE . "?controller=affecterController&view=affecter_list" ?>">Affectation</a></li> 
            </ul>
               </li>
                </ul>
                <ul>
               <li>
               <a href="<?= WEB_ROUTE . "?controller=equipeController&view=equipe_list" ?>">
                    <i class='fa fa-users nav_icon'></i>
                    <span class="nav_name">Equipe</span>
                </a>
            <ul class="dropdown">
            <li><a href="<?= WEB_ROUTE . "?controller=membreController&view=membre_list" ?>">Membres</a>
        </li>
        
            </ul>
               </li>
                </ul>
                <div id="user-btn" class="fas fa-user" onclick="hideShow()"></div>
        <div class="count-box" id="counta">
        <p>Bienvenue <span><?php echo $_SESSION['connectedUser'][0]["prenomU"] ," ", $_SESSION['connectedUser'][0]["nomU"];?>!!!</span></p>
        <p><span><?php echo $_SESSION['connectedUser'][0]["emailU"]; ?></span></p>
      <a href="<?= WEB_ROUTE . "?controller=securityController&view=deconnexion" ?>" class="delete-btn">déconnexion</a>
      </div>
</header>

        
<!--Container Main start-->