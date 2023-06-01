
<?php
// if(!is_admin()) header("Location:".WEB_ROUTE."?controller=affaireController&view=affaire");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['view'])) {
        if ($_GET['view'] == "login") {
            require_once(ROUTE_DIR . 'view/security/login.html.php');
        } elseif ($_GET['view'] == "register") {
            require_once(ROUTE_DIR.'view/security/register.html.php');
        }elseif ($_GET['view'] == "deconnexion") {
            destroy_session();
            require_once(ROUTE_DIR . 'view/security/login.html.php');
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        if($_POST["action"] == "login") {
            login($_POST);
        }elseif($_POST["action"] == "register") {
            inscription($_POST);
        }
    }
}

function login(array $data) {
    $arrayError = [];
    extract($data);
  
     valide_libelle($arrayError, "emailU", $emailU);
     valide_libelle($arrayError, "passwordU", $passwordU);

    if (empty($arrayError)) {
        $user = [
            "emailU"=>$emailU,
            "passwordU"=>$passwordU,
        ];
        $result = get_user_by_login_password_db($user);
        if ($result != null) {
            $_SESSION['connectedUser'] = $result;
       header("location:" . WEB_ROUTE . "?controller=projetController&view=projet_list");
        } else {
            $arrayError['error'] = "E-mail ou mot de passe incorrect";
            $_SESSION['arrayError'] = $arrayError;
            header("location:" . WEB_ROUTE . "?controller=securityController&view=login");
        }
    } else {
        $_SESSION['arrayError'] = $arrayError;
        header("location:" . WEB_ROUTE . "?controller=securityController&view=login");
    }
} 

function inscription(array $data) {
    $arrayError = [];
    extract($data);
    valide_libelle($arrayError, "nomU", $nomU);
    valide_libelle($arrayError, "prenomU", $prenomU);
     valide_libelle($arrayError, "emailU", $emailU);
     valide_libelle($arrayError, "passwordU", $passwordU);
    if (empty($arrayError)) {
        $user = [
            "nomU"=>$nomU,
            "prenomU"=>$prenomU,
            "emailU"=>$emailU,
            "passwordU"=>$passwordU,
        ];
        // var_dump($user);die;
        $result = ajout_users_db($user);
        if ($result != null) {
            $_SESSION['connectedUser'] = $result;
       // var_dump($result[0]['libelleR']);die;
                header("location:".WEB_ROUTE.'?controller=securityController&view=login');
        } else {
            $arrayError['error'] = "E-mail ou mot de passe incorrect";
            $_SESSION['arrayError'] = $arrayError;
            header("location:" . WEB_ROUTE . "?controller=securityController&view=register");
        }
    } else {
        $_SESSION['arrayError'] = $arrayError;
        header("location:" . WEB_ROUTE . "?controller=securityController&view=register");
    }
} 

function deconnexion(){
    unset($_SESSION['connectedUser']);
} 

?>

