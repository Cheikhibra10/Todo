<?php

function ajout_projet_db(array $projet)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO projet (nomP,descriptionP,idU,Etat) VALUES(:nomP,:descriptionP,:idU,:Etat)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($projet);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_projet_db(array $projet)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE projet SET nomP=:nomP,descriptionP=:descriptionP WHERE idP=:idP";
        $stmt = $conn->prepare($sql);
        $stmt->execute($projet);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function archive_projet_db(array $archive)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE projet SET Etat=:Etat WHERE idP=:idP";
        $stmt = $conn->prepare($sql);
        $stmt->execute($archive);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_projet_db()
{   
    $idI = $_SESSION['connectedUser'][0]['idU'];
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM projet WHERE idU = $idI AND Etat = 1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de projet
    return $stmt->fetchAll();
}
function get_projet_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM projet WHERE idP=:idP";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idP' => $id]);
        return get_all_projet_db();
    } catch (\Throwable $th) {
        return false;
    }
}


function get_projet_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM projet WHERE idP =:idP";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idP' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_projet($filtre): array
{
 $idI = $_SESSION['connectedUser'][0]['idU'];
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM projet WHERE nomP like '%".$filtre."%' AND idU = $idI");
 $stmt->execute();
 return $stmt->fetchAll();
}
?>
