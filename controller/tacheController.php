<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "tache_add") {
            $id = (int) $_GET["idC"];
            $categorieEdit = get_categorie_by_id_bd($id);
            $_SESSION['categorie'] = $categorieEdit[0];
            require_once(ROUTE_DIR . 'view/tache/tache_add.html.php');
        } elseif ($_GET['view'] == "tache_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_tache_db();
            $tachelist = get_list_per_page($totalList, $page, 3);
            $nbrePage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idT"];
         $categories =  get_all_categorie_db();
            $tacheEdit = get_tache_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/tache/tache_add.html.php');
        } elseif ($_GET['view'] == "soustache_add") {
            $id = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/soustache/soustache_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idT"];
            $tacheDelet = get_tache_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_list");
        } elseif ($_GET['view'] == "affecter_add") {
            $id = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/affecter/affecter_add.html.php');
        } elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idT"];
            $tacheArchive = archivee($id);
        }elseif ($_GET['view'] == "filtrer") {
            show_all_tache();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "tache_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_tache($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_tache($_POST);
        }
    }
}




function ajout_tache($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "libelleT", $libelleT);
    valide_libelle($arrayError, "descriptionT", $descriptionT);

    if (empty($arrayError)) {
        $is_user_connect = $_SESSION["connectedUser"];
        $tache = [
            "libelleT" => $libelleT,
            "descriptionT" => $descriptionT,
            "dated" => $dated,
            "datef" => $datef,
            "idC" => $_SESSION['categorie'],
            "idU" =>($is_user_connect[0]["idU"])
        ];
        $result = ajout_tache_db($tache);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_add");
    }
}

function edit_tache($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleT", $libelleT);
    valide_libelle($arrayError, "descriptionT", $descriptionT);

    if (empty($arrayError)) {
        $tache = [
            "libelleT" => $libelleT,
            "descriptionT" => $descriptionT,
            "dated" => $dated,
            "datef" => $datef,
            "idC" => $idC,
            "idT" => $idT,

        ];
        // var_dump($tache);die;
        $result = edit_tache_db($tache);
        header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_add");
    }
}

function show_all_tache()
{
if(isset($_GET['OK'])){
  $tachelist = filtre_by_tache($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
}else{
  $tachelist = get_all_tache_db();
   require_once(ROUTE_DIR . 'view/tache/tache_list.html.php');
}
}

function archivee(string $id):array{
    $totalList = get_all_tache_db();
    foreach ($totalList as $value) {
        if($value['idT']== $id){
            if ($value['Etat'] == 1){
                $value['Etat'] = 0;
                return get_archivee($value);
            }
        }
    }
    return[];
}

function get_archivee(array $newData){
      extract($newData);
      $tache = [
        "idT" => $idT,
        "Etat"=> $Etat
    ];
     $result = archive_tache_db($tache);
      header("Location:" . WEB_ROUTE . "?controller=tacheController&view=tache_list");
}