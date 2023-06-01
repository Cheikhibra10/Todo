<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "equipe_add") {
         $projets = get_all_projet_db(); 
            require_once(ROUTE_DIR . 'view/equipe/equipe_add.html.php');
        } elseif ($_GET['view'] == "equipe_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_equipe1_db();
            $equipelist = get_list_per_page($totalList, $page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/equipe/equipe_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idE"];
            $projets = get_all_projet_db(); 
            $equipeEdit = get_equipe_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/equipe/equipe_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idE"];
            $equipeDelet = get_equipe_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idE"];
            $equipeArchive = archive($id);
        }elseif ($_GET['view'] == "filtrer") {
            show_all_equipe();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "equipe_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_equipe($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_equipe($_POST);
        }
    }
}




function ajout_equipe($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "nomE", $nomE);

    if (empty($arrayError)) {
        $is_user_connect = $_SESSION["connectedUser"];

        $equipe = [
            "nomE" => $nomE,
            "idP" => $idP,
            "idU" =>($is_user_connect[0]["idU"]),
        ];
        // var_dump($equipe);die;
        $result = ajout_equipe_db($equipe);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_add");
    }
}

function edit_equipe($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomE", $nomE);

    if (empty($arrayError)) {
        $equipe = [
         "nomE" => $nomE,
         "idP" => $idP,
         "idE" => $idE,
        ];
        $resulte = edit_equipe_db($equipe);
        // var_dump($resulte);die;
        header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_add");
    }
}

function show_all_equipe()
{
if(isset($_GET['OK'])){
  $equipelist = filtre_by_equipe($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/equipe/equipe_list.html.php');
}else{
  $equipelist = get_all_equipe_db();
   require_once(ROUTE_DIR . 'view/equipe/equipe_list.html.php');
}
}

function archive(string $id):array{
    $totalList = get_all_equipe_db();
    foreach ($totalList as $value) {
        if($value['idE']== $id){
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
    $equipe = [
        "idE" => $idE,
        "Etat"=> $Etat
    ];
    // var_dump($totalList);die;
    // var_dump($equipe);die;
     $result = archive_equipe_db($equipe);
    //  var_dump($result);die;
      header("Location:" . WEB_ROUTE . "?controller=equipeController&view=equipe_list");
}