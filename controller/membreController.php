<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "membre_add") {
         $users = get_all_user_db(); 
         $equipes = get_all_equipe_db(); 
            require_once(ROUTE_DIR . 'view/membre/membre_add.html.php');
        } elseif ($_GET['view'] == "membre_list") {
            $page = 1;
            if (isset($_GET['page'])) {
             $page = (int)$_GET['page'];
            
            }
            // var_dump($_SESSION['connectedUser']);die;
            
            $totalList = get_all_userEquipe_db();
            $membrelist = get_list_per_page($totalList, $page, 3);
            $nbrPage = get_nbrpage($totalList, 3);
            require_once(ROUTE_DIR . 'view/membre/membre_list.html.php');
           } elseif ($_GET['view'] == "enlever") {
            $id = (int) $_GET["idUE"];
            $membreArchive = enleverTAche($id);
            var_dump($membreArchive);die;
            header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
        } elseif ($_GET['view'] == "rappel_add") {
            $id = (int) $_GET["idUE"];
            $tacheEdit = get_tache2_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/rappel/rappel_add.html.php');
        }elseif ($_GET['view'] == "rappel_add") {
            $id = (int) $_GET["idUE"];
            $membreEdit = get_user2_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/rappel/rappel_add.html.php');
         } elseif ($_GET['view'] == "edit") {
            $id = (int) $_GET["idUE"];
            $users = get_all_user_db(); 
            $equipes = get_all_equipe_db(); 
            $membreEdit = get_membre_by_id_bd($id);
            require_once(ROUTE_DIR . 'view/membre/membre_add.html.php');
        } elseif ($_GET['view'] == "delet") {
            $id = (int) $_GET["idUE"];
            $membreDelet = get_membre_by_idCF_db($id);
            header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
        }elseif ($_GET['view'] == "archive") {
            $id = (int) $_GET["idUE"];
            $membreArchive = archive($id);
            
        }
        elseif ($_GET['view'] == "filtrer") {
            show_all_membre();    
          }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST["action"] == "membre_add") {
            unset($_POST['Controller']);
            unset($_POST['action']);
            unset($_POST['submit']);
            ajout_membre($_POST);
        } elseif ($_POST["action"] == "edit") {
            edit_membre($_POST);
        }
    }
}




function ajout_membre($data)
{
    extract($data);
    $arrayError = [];
    if (empty($arrayError)) {
    foreach ($_POST['idU'] as $value) {
     $membre = [
        'idU' => $value,
        'idE' => $idE
    ];
    // var_dump($membre);die;
    $result = ajout_userEquipe_db($membre);
    // var_dump($result);die;
    header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
    };
 } else {
    $_SESSION["error"] = $arrayError;
    header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_add");
}
}

function edit_membre($data)
{
    $arrayError = array();
    extract($data);

    if (empty($arrayError)) {
        foreach ($_POST['idU'] as $value) {
            $membre = [
               'idU' => $value,
               'idE' => $idE,
               'idUE' => $idUE,
           ];
        // var_dump($membre);die;
        $result = edit_membre_db($membre);
        // var_dump($result);die;
        header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
        }
    } else {
        $_SESSION["error"] = $arrayError;
        header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_add");
    }
}

function show_all_membre()
{
if(isset($_GET['OK'])){
  $membrelist = filtre_by_member($_GET['recherche']);
   require_once(ROUTE_DIR . 'view/membre/membre_list.html.php');
}else{
  $membrelist = get_all_membre_db();
   require_once(ROUTE_DIR . 'view/membre/membre_list.html.php');
}
}

function archive(string $id):array{
    $totalList = get_all_userEquipe_db();
    foreach ($totalList as $value) {
        if($value['idUE']== $id){
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
    $membre = [
        "idUE" => $idUE,
        "Etat" => $Etat
    ];
    // var_dump($membre);die;
     $result = archive_membre_db($membre);
    //  var_dump($result);die;
      header("Location:" . WEB_ROUTE . "?controller=membreController&view=membre_list");
}