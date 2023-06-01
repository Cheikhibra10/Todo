<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "affecter_add") {
            $id = (int) $_GET["idT"];
            $tacheEdit = get_tache_by_id_bd($id);
            $_SESSION['tache'] = $tacheEdit[0];
            $membres =  get_users();
            // var_dump($membres);die;
            require_once(ROUTE_DIR . 'view/affecter/affecter_add.html.php');
        } elseif ($_GET['view'] == "affecter_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_tache1_db();
            $affecterlist = get_list_per_page($totalList, $page, 3);
            $nbrePage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/affecter/affecter_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idUE"];
            $affecterEdit = get_affecter_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/affecter/affecter_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idUE"];
            $affecterDelet = get_affecter_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=affecterController&view=affecter_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idUE"];
            $affecterArchive = archivee($id);
        }elseif ($_GET['view'] == "filtrer") {
            show_all_affecter();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "affecter_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_affecter($_POST);
            // var_dump($_POST);die;
        } elseif ($_POST["action"] == "edit") {
            edit_affecter($_POST);
        }
    }
}




function ajout_affecter($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "idU", $idU);

    if (empty($arrayError)) {
        $affecter = [
            "idU" => $idU,
            "idT" => $_SESSION['tache'],
        ];
        // var_dump($affecter);die;
        $result = affecter_tache_db($affecter);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=affecterController&view=affecter_add");
    }
}

function edit_affecter($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleC", $libelleC);

    if (empty($arrayError)) {
        $affecter = [
            "libelleC" => $libelleC,
            "idP" => $idP,
            "idC"=> $idC,
        ];
        // var_dump($affecter);die;
        $result = edit_affecter_db($affecter);
        header("Location:" . WEB_ROUTE . "?controller=affecterController&view=affecter_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=affecterController&view=affecter_add");
    }
}

function show_all_affecter()
{
if(isset($_GET['OK'])){
  $affecterlist = filtre_by_affecter($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/affecter/affecter_list.html.php');
}else{
  $affecterlist = get_all_affecter_db();
   require_once(ROUTE_DIR . 'view/affecter/affecter_list.html.php');
}
}

function archivee(string $id):array{
    $totalList = get_all_affecter_db();
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
      $affecter = [
        "idT" => $idT,
        "Etat"=> $Etat
    ];
     $result = archive_affecter_db($affecter);
      header("Location:" . WEB_ROUTE . "?controller=affecterController&view=affecter_list");
}