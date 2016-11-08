<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$idUser1 = $_POST['user_id'];
$idUser2 = $_POST['friend_id'];

echo json_encode( addFriend($idUser1,$idUser2));

/**
 * DeleteFriend
 * ************************
 * Comentarios: Elimina la relacion entre los usuarios
 * Entradas: el id de los usuarios
 * Salidas: unResponse
 * Precondiciones: ninguna
 * Postcondiciones: se devolvera una respuesta de 200 si se ha realizado o una 404 si no
 */
function addFriend($idUser1,$idUser2){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "DELETE FROM `T_Amigos` WHERE ((`Usuario1`= :user1 ||`Usuario2`= :user1) AND (`Usuario1`= :user2 ||`Usuario2`= :user2))";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user1', $idUser1, PDO::PARAM_STR);
    $stmt->bindParam(':user2', $idUser2, PDO::PARAM_STR);


    if ($stmt->execute() === TRUE) {
        $res = new Response();
        $res->setStatus(200);
        $res->setMessage("OK");
    } else {
        $res = new Response();
        $res->setStatus(404);
        $res->setMessage("ERROR");
    }
    return $res;
}