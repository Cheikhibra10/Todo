<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "soustache_add") {
            $id = (int) $_GET["idT"];
            // var_dump($id);die;
            $tacheEdit = get_tache_by_id_bd($id);
            $_SESSION['tache'] = $tacheEdit[0];
            // var_dump($_SESSION['tache']);die;
            require_once(ROUTE_DIR . 'view/soustache/soustache_add.html.php');
        } elseif ($_GET['view'] == "soustache_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_soustache_db();
            $soustachelist = get_list_per_page($totalList, $page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/soustache/soustache_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idST"];
          $taches = get_all_tache_db(); 
            $soustacheEdit = get_soustache_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/soustache/soustache_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idST"];
            $soustacheDelet = get_soustache_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idST"];
            $soustacheArchive = archive($id);
            
        }elseif ($_GET['view'] == "filtrer") {
            show_all_soustache();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "soustache_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_soustache($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_soustache($_POST);
        }
    }
}




function ajout_soustache($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "libelleST", $libelleST);
    if (empty($arrayError)) {
        $is_user_connect = $_SESSION["connectedUser"];

        $soustache = [
            "libelleST" => $libelleST,
            "idT" => $_SESSION['tache'],
            "idU" =>($is_user_connect[0]["idU"]),
        ];
        // var_dump($soustache['idT']);die;
        $result = ajout_soustache_db($soustache);
        header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_add");
    }
}

function edit_soustache($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleST", $libelleST);

    if (empty($arrayError)) {
        $soustache = [
            "libelleST" => $libelleST,
            "idT" => $idT,
            "idST"=> $idST,
        ];
        // var_dump($soustache);die;
        $result = edit_soustache_db($soustache);
        header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_add");
    }
}

function show_all_soustache()
{
if(isset($_GET['OK'])){
  $soustachelist = filtre_by_soustache($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/soustache/soustache_list.html.php');
}else{
  $soustachelist = get_all_soustache_db();
   require_once(ROUTE_DIR . 'view/soustache/soustache_list.html.php');
}
}

function archive(string $id):array{
    $totalList = get_all_soustache_db();
    foreach ($totalList as $value) {
        if($value['idST']== $id){
            if ($value['Etat'] == 1){
                $value['Etat'] = 0;
                return get_archive($value);
            }
        }
    }
    return[];
}

function get_archive(array $newData){
      extract($newData);
      $soustache = [
        "idST" => $idST,
        "Etat"=> $Etat
    ];
    // var_dump($soustache);die;
     $result = archive_soustache_db($soustache);
    //  var_dump($result);die;
      header("Location:" . WEB_ROUTE . "?controller=soustacheController&view=soustache_list");
}