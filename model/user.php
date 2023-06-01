<?php
function get_user_by_login_password_db(array $user) {
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM user where emailU=:emailU AND passwordU=:passwordU";
    // execution de la requete sql
    $stmt = $conn->prepare($sql);
    $stmt->execute($user);
    // ferme la connection a la base de donnees
    $conn = null;
    return $stmt->fetchAll();
}
function ajout_users_db(array $user)
{
    $conn = get_connection();
    try {
        $sql = "INSERT INTO user (nomU,prenomU,emailU,passwordU) VALUES(:nomU,:prenomU,:emailU,:passwordU)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($user);
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}
function get_all_user_db()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM user";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de tache
    return $stmt->fetchAll();
}
function get_user2_by_id_bd(int $id)
{
    $conn = get_connection();
    $sql ="SELECT prenomU,nomU FROM userequipe ue,user u WHERE ue.idU=u.idU AND idUE =:idUE";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['idUE' => $id]);
    $conn = null;
    return $stmt->fetch();
}


function get_users()
{
    // connection a la base de donnees
    $conn = get_connection();
    // requete sql
    $sql = "SELECT * FROM userequipe ue,user u WHERE ue.idU=u.idU";
    // execution de la requete sql
    $stmt = $conn->query($sql);
    // ferme la connection a la base de donnees
    $conn = null;
    // retourne le tableau de categorie
    return $stmt->fetchAll();
}
?>