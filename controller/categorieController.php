<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "categorie_add") {
            $id = (int) $_GET["idP"];
            $projetEdit = get_projet_by_id_bd($id);
            $_SESSION['projet'] = $projetEdit[0];
            require_once(ROUTE_DIR . 'view/categorie/categorie_add.html.php');
        } elseif ($_GET['view'] == "categorie_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_categorie_db();
            $categorielist = get_list_per_page($totalList, $page, 3);
            $nbrePage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/categorie/categorie_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $projets =  get_all_projet_db();
            $id = (int) $_GET["idC"];
            $categorieEdit = get_categorie_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/categorie/categorie_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idC"];
            $categorieDelet = get_categorie_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
        }elseif ($_GET['view'] == "filtrer") {
            show_all_categorie();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "categorie_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_categorie($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_categorie($_POST);
        }
    }
}




function ajout_categorie($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "libelleC", $libelleC);
    valide_libelle($arrayError, "idP", $idP);

    if (empty($arrayError)) {
        $is_user_connect = $_SESSION["connectedUser"];
        $categorie = [
            "libelleC" => $libelleC,
            "idP" => $_SESSION['projet'],
            "idU" =>($is_user_connect[0]["idU"])
        ];
        // var_dump($categorie);die;
        $result = ajout_categorie_db($categorie);
        header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_add");
    }
}

function edit_categorie($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleC", $libelleC);

    if (empty($arrayError)) {
        $categorie = [
            "libelleC" => $libelleC,
            "idP" => $idP,
            "idC"=> $idC,
        ];
        // var_dump($categorie);die;
        $result = edit_categorie_db($categorie);
        header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=categorieController&view=categorie_add");
    }
}

function show_all_categorie()
{
if(isset($_GET['OK'])){
  $categorielist = filtre_by_categorie($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/categorie/categorie_list.html.php');
}else{
  $categorielist = get_all_categorie_db();
   require_once(ROUTE_DIR . 'view/categorie/categorie_list.html.php');
}
}