<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "transfert_add") {
            $id = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($id);
            $_SESSION['tache'] = $tacheEdit[0];
            $categories =  get_all_categorie_db();
            require_once(ROUTE_DIR . 'view/transfert/transfert_add.html.php');
        } elseif ($_GET['view'] == "transfert_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_tache1_db();
            $transfertlist = get_list_per_page($totalList, $page, 3);
            $nbrePage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/transfert/transfert_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idT"];
            $transfertEdit = get_transfert_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/transfert/transfert_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idT"];
            $transfertDelet = get_transfert_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idT"];
            $transfertArchive = archivee($id);
        }elseif ($_GET['view'] == "filtrer") {
            show_all_transfert();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "transfert_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_transfert($_POST);
            var_dump($_POST);die;
        } elseif ($_POST["action"] == "edit") {
            edit_transfert($_POST);
        }
    }
}




function ajout_transfert($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "idC", $idC);

    if (empty($arrayError)) {
        $transfert = [
            "idC" => $idC,
            "idT" =>$_SESSION['tache'],
        ];
        // var_dump($transfert);die;
        $result = edit_tache1_db($transfert);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_add");
    }
}

function edit_transfert($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleC", $libelleC);

    if (empty($arrayError)) {
        $transfert = [
            "libelleC" => $libelleC,
            "idP" => $idP,
            "idC"=> $idC,
        ];
        // var_dump($transfert);die;
        $result = edit_transfert_db($transfert);
        header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_add");
    }
}

function show_all_transfert()
{
if(isset($_GET['OK'])){
  $transfertlist = filtre_by_transfert($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/transfert/transfert_list.html.php');
}else{
  $transfertlist = get_all_transfert_db();
   require_once(ROUTE_DIR . 'view/transfert/transfert_list.html.php');
}
}

function archivee(string $id):array{
    $totalList = get_all_transfert_db();
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
      $transfert = [
        "idT" => $idT,
        "Etat"=> $Etat
    ];
     $result = archive_transfert_db($transfert);
      header("Location:" . WEB_ROUTE . "?controller=transfertController&view=transfert_list");
}