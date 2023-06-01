<?php

function ajout_equipe_db(array $equipe)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO equipe (nomE,idP,idU) VALUES(:nomE,:idP,:idU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($equipe);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
function ajout_userEquipe_db($membre)
{
   //var_dump($membre);die;
    $conn = get_connection();
        try {
            $sql = "INSERT INTO userequipe (idU,idE) VALUES(:idU,:idE)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($membre);
            return true;
        } catch (\Throwable $th) {
            return false;
        }  
}
function edit_equipe_db(array $equipe)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE equipe SET nomE=:nomE,idP=:idP WHERE idE=:idE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($equipe);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
function edit_membre_db(array $equipe)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE userequipe SET idU=:idU,idE=:idE WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($equipe);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}



function get_equipe_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM equipe WHERE idE=:idE";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idE' => $id]);
        return get_all_equipe_db();
    } catch (\Throwable $th) {
        return false;
    }
}




function get_membre_by_idCF_db(int $id)
{
    $conn = get_connection();
    try {
        $sql = "DELETE FROM userequipe WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idUE' => $id]);
        return get_all_equipe_db();
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_equipe_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM equipe";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de equipe
    return $stmt->fetchAll();
}
function get_all_equipe1_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM equipe e,projet p WHERE e.idP=p.idP AND e.Etat = 1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de equipe
    return $stmt->fetchAll();
}

function get_all_equipe2_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM equipe Where Etat = 1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de equipe
    return $stmt->fetchAll();
}

function get_all_userEquipe_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM userequipe ue,user u,equipe e,tache t WHERE ue.idU=u.idU AND ue.idE=e.idE AND ue.idT=t.idT AND ue.Etat = 1";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de tache
    return $stmt->fetchAll();
}
function archive_equipe_db(array $archive)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE equipe SET Etat=:Etat WHERE idE=:idE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($archive);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}

function archive_membre_db(array $archive)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE userequipe SET Etat=:Etat WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($archive);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function get_equipe_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM equipe WHERE idE =:idE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idE' => $id]);
    $conn = null;
    return $stmt->fetch();
}

function get_membre_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql = "SELECT * FROM userequipe WHERE idUE =:idUE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idUE' => $id]);
    $conn = null;
    return $stmt->fetch();
}
function filtre_by_equipe($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM equipe WHERE nomE like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}
function filtre_by_member($filtre): array
{
 $conn = get_connection();
 $stmt = $conn->prepare("SELECT * FROM userequipe ue,user u,equipe e WHERE ue.idU=u.idU AND ue.idE=e.idE AND prenomU like '%".$filtre."%'");
 $stmt->execute();
 return $stmt->fetchAll();
}

function enlever_tache_db(array $tache)
{
    $conn = get_connection();
    try {
        $sql = "UPDATE userequipe SET idT=:idT WHERE idUE=:idUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute($tache);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
?>
