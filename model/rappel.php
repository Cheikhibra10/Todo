<?php

function ajout_rappel_db(array $rappel)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO rappel (libelleRA,idU,idT) VALUES(:libelleRA,:idU,:idT)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($rappel);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function edit_rappel_db(array $rappel)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE rappel SET libelleST=:libelleST,idT=:idT WHERE idST=:idST";
        $stmt = $conn->prepare($sql);
        $stmt->execute($rappel);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}




function get_rappel_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM rappel WHERE idST=:idST";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idST' => $id]);
        return get_all_rappel_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_rappel_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM rappel r,user u,tache t WHERE r.idU=u.idU AND r.idT=t.idT";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de rappel
    return $stmt->fetchAll();
}

function get_rappel_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM rappel WHERE idST =:idST";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idST' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_rappel($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM rappel WHERE libelleST like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}
?>
