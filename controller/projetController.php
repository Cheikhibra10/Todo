<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "projet_add") {
            require_once(ROUTE_DIR . 'view/projet/projet_add.html.php');
        } elseif ($_GET['view'] == "projet_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            
            }       
            // var_dump($_SESSION['connectedUser']);die;
                
            $totalList = get_all_projet_db();
            $projetlist = get_list_per_page($totalList, $page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/projet/projet_list.html.php');
           } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idP"];
            $projetEdit = get_projet_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/projet/projet_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idP"];
            $projetDelet = get_projet_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idP"];
            $projetArchive = archive($id);
            
        }elseif ($_GET['view'] == "filtrer") {
            show_all_projet();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "projet_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_projet($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_projet($_POST);
        }
    }
}




function ajout_projet($data)
{
    extract($data);
    $arrayError = [];
    valide_libelle($arrayError, "nomP", $nomP);
    valide_libelle($arrayError, "descriptionP", $descriptionP);

    if (empty($arrayError)) {
        $is_user_connect = $_SESSION["connectedUser"];
        $Etat = 1;
        $projet = [
            "nomP" => $nomP,
            "descriptionP" => $descriptionP,
            "idU" =>($is_user_connect[0]["idU"]),
            "Etat" => $Etat
        ];
        // var_dump($projet);die;
        $result = ajout_projet_db($projet);
        header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_add");
    }
}

function edit_projet($data)
{
    $arrayError = array();
    extract($data);
    valide_libelle($arrayError, "nomP", $nomP);

    if (empty($arrayError)) {
        $projet = [
            "nomP" => $nomP,
            "descriptionP" => $descriptionP,
            "idP"=> $idP,
        ];
        // var_dump($projet);die;
        $result = edit_projet_db($projet);
        header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_list");
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_add");
    }
}

function show_all_projet()
{
if(isset($_GET['OK'])){
  $projetlist = filtre_by_projet($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/projet/projet_list.html.php');
}else{
  $projetlist = get_all_projet_db();
   require_once(ROUTE_DIR . 'view/projet/projet_list.html.php');
}
}

function archive(string $id):array{
    $totalList = get_all_projet_db();
    foreach ($totalList as $value) {
        if($value['idP']== $id){
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
      $projet = [
        "idP" => $idP,
        "Etat"=> $Etat
    ];
    // var_dump($projet);die;
     $result = archive_projet_db($projet);
    //  var_dump($result);die;
      header("Location:" . WEB_ROUTE . "?controller=projetController&view=projet_list");
}