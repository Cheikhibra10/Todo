<?php

function ajout_categorie_db(array $categorie)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO categorie (libelleC,idP,idU) VALUES(:libelleC,:idP,:idU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorie);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_categorie_db(array $categorie)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE categorie SET libelleC=:libelleC,idP=:idP WHERE idC=:idC";
        $stmt = $conn->prepare($sql);
        $stmt->execute($categorie);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function get_categorie_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM categorie WHERE idC=:idC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idC' => $id]);
        return get_all_categorie_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_categorie_db()
{
    $id = $_SESSION['connectedUser'][0]['idU'];
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM categorie WHERE idU = $id";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorie
    return $stmt->fetchAll();
}

function get_categorie_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM categorie WHERE idC =:idC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idC' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_categorie($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM categorie WHERE libelleC like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}
?>
