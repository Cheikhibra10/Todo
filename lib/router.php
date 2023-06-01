<?php
if (is_user_connect() || (isset($_REQUEST['controller']) && $_REQUEST['controller'] == "securityController")) {
    if (isset($_REQUEST['controller'])) {
        if ($_REQUEST['controller'] == "projetController") {
            require_once(ROUTE_DIR . 'controller/projetController.php');
        } elseif ($_REQUEST['controller'] == "categorieController") {
            require_once(ROUTE_DIR . 'controller/categorieController.php');
        }elseif ($_REQUEST['controller'] == "tacheController") {
            require_once(ROUTE_DIR . 'controller/tacheController.php');
        }elseif ($_REQUEST['controller'] == "soustacheController") {
            require_once(ROUTE_DIR . 'controller/soustacheController.php');
        }elseif ($_REQUEST['controller'] == "transfertController") {
            require_once(ROUTE_DIR . 'controller/transfertController.php');
        }elseif ($_REQUEST['controller'] == "equipeController") {
            require_once(ROUTE_DIR . 'controller/equipeController.php');
        }elseif ($_REQUEST['controller'] == "membreController") {
            require_once(ROUTE_DIR . 'controller/membreController.php');
        }elseif ($_REQUEST['controller'] == "affecterController") {
            require_once(ROUTE_DIR . 'controller/affecterController.php');
        }elseif ($_REQUEST['controller'] == "rappelController") {
            require_once(ROUTE_DIR . 'controller/rappelController.php');
        } elseif ($_REQUEST['controller'] == "securityController") {
            require_once(ROUTE_DIR . 'controller/securityController.php');
        }
    } else {
        require_once(ROUTE_DIR . 'view/security/login.html.php');
    }
} else {
    require_once(ROUTE_DIR . 'view/security/login.html.php');
}
?>