<?php

function edit_tache1_db(array $tache)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE tache SET idC=:idC WHERE idT=:idT";
        $stmt = $conn->prepare($sql);
        $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        var_dump($th);die;
        return false;
    }
}
function get_all_tache1_db()
{
    $id = $_SESSION['connectedUser'][0]['idU'];
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM tache t,categorie c WHERE t.idT=c.idC ";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de tache
    return $stmt->fetchAll();
}
?>
