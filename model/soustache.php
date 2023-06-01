<?php

function ajout_soustache_db(array $soustache)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO sous_tache (libelleST,idT,idU) VALUES(:libelleST,:idT,:idU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($soustache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_soustache_db(array $soustache)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE sous_tache SET libelleST=:libelleST,idT=:idT WHERE idST=:idST";
        $stmt = $conn->prepare($sql);
        $stmt->execute($soustache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}




function get_soustache_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM sous_tache WHERE idST=:idST";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idST' => $id]);
        return get_all_soustache_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_soustache_db()
{
    $id = $_SESSION['connectedUser'][0]['idU'];
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM sous_tache WHERE idU = $id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de soustache
    return $stmt->fetchAll();
}

function get_soustache_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM sous_tache WHERE idST =:idST";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idST' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_soustache($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM sous_tache WHERE libelleST like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}
?>
