<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "rappel_add") {
            $id = (int) $_GET["idUE"];
            $tacheEdit = get_tache2_by_id_bd($id);
            $_SESSION['tache'] = $tacheEdit[0];
            $membreEdit = get_user2_by_id_bd($id);
            $_SESSION['membre'] = $membreEdit[0];
            // var_dump($_SESSION['membre']);die;
            require_once(ROUTE_DIR . 'view/rappel/rappel_add.html.php');
        } elseif ($_GET['view'] == "rappel_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_rappel_db();
            $rappellist = get_list_per_page($totalList, $page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/rappel/rappel_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idST"];
          $taches = get_all_tache_db(); 
            $rappelEdit = get_rappel_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/rappel/rappel_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idST"];
            $rappelDelet = get_rappel_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=rappelController&view=rappel_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idST"];
            $rappelArchive = archive($id);
            
        }elseif ($_GET['view'] == "filtrer") {
            show_all_rappel();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "rappel_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_rappel($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_rappel($_POST);
        }
    }
}




function ajout_rappel($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "libelleRA", $libelleRA);
    if (empty($arrayError)) {

        $rappel = [
            "libelleRA" => $libelleRA,
            "idT" => $_SESSION['tache'],
            "idU" => $_SESSION['membre'],
        ];
        $result = ajout_rappel_db($rappel);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=rappelController&view=rappel_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=rappelController&view=rappel_add");
    }
}

function edit_rappel($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "libelleST", $libelleST);

    if (empty($arrayError)) {
        $rappel = [
            "libelleST" => $libelleST,
            "idT" => $idT,
            "idST"=> $idST,
        ];
        // var_dump($rappel);die;
        $result = edit_rappel_db($rappel);
        header("Location:" . WEB_ROUTE . "?controller=rappelController&view=rappel_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=rappelController&view=rappel_add");
    }
}

function show_all_rappel()
{
if(isset($_GET['OK'])){
  $rappellist = filtre_by_rappel($_GET['recherche']);
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