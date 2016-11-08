<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$idGame = $_POST['idgame'];
if(deleteGameUser($idGame)==TRUE) {
    echo json_encode(deleteGame($idGame));
}

/**
 * DeleteGameUser
 * ************************
 * Comentarios: Elimina la relacion de juego con el usuario
 * Entradas: el id del juego
 * Salidas: ninguna
 * Precondiciones: ninguna
 * Postcondiciones: ninguna
 */
function deleteGameUser($idGame){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "DELETE FROM `T_Usuarios_Games` WHERE `Game`=:idGame";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idGame', $idGame, PDO::PARAM_STR);
    $res = FALSE;
    if ($stmt->execute() === TRUE) {
        $res= TRUE;
    }
    return $res;
}

/**
 * DeleteGame
 * ************************
 * Comentarios: Elimina el juego de la base de datos
 * Entradas: idGame
 * Salidas: unResponse
 * Precondiciones: ninguna
 * Postcondiciones: se devolvera una respuesta de 200 si se ha eliminado o una 404 si no
 */
function deleteGame($idGame){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "DELETE FROM `T_Games` WHERE `Id`=:idGame";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idGame', $idGame, PDO::PARAM_STR);

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