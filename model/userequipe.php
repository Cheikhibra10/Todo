<?php

function equipe(array $equipe)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO equipe(nomE) VALUES(:dateAP, :idF, :montantAP, :idU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($approvisionnement);
        $lastID = $conn->lastInsertId();
        $conn = null;
        return $lastID;
    } catch (\Throwable $th) {
        return 0;
    }
}

function ajout_approarticleconfection_db(array $approArticle)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO aprroarticleconfection(idAP, idAC, quantite) VALUES(:idAP, :idAC, :quantite)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($approArticle);
        $conn = null;
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
?>