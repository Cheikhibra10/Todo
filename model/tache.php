<?php

function ajout_tache_db(array $tache)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO tache (libelleT,descriptionT,dated,datef,idC,idU) VALUES(:libelleT,:descriptionT,:dated,:datef,:idC,:idU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_tache_db(array $tache)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE tache SET libelleT=:libelleT,descriptionT=:descriptionT,dated=:dated,datef=:datef,idC=:idC WHERE idT=:idT";
        $stmt = $conn->prepare($sql);
        $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function get_tache_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM tache WHERE idC=:idC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idC' => $id]);
        return get_all_tache_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_tache_db()
{
    $id = $_SESSION['connectedUser'][0]['idU'];
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM tache WHERE idU = $id AND Etat = 1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de tache
    return $stmt->fetchAll();
}
function archive_tache_db(array $archive)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE tache SET Etat=:Etat WHERE idT=:idT";
        $stmt = $conn->prepare($sql);
        $stmt->execute($archive);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function get_tache_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM tache WHERE idT =:idT";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idT' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function get_tache2_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT libelleT FROM userequipe ue,tache t WHERE ue.idT=t.idT AND idUE =:idUE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idUE' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_tache($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM tache WHERE libelleT like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}

function affecter_tache_db(array $tache)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE userequipe SET idT=:idT WHERE idU=:idU";
        $stmt = $conn->prepare($sql);
        $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        // var_dump($th);die;
        return false;
    }
}
?>
