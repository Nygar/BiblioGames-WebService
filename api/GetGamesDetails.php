<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Games.php';
require_once __DIR__ . '/../util/Mapper.php';

$id = $_GET['id_game'];
echo json_encode( getGamesDetail($id));
/**
 * Funcion para obtener los detalles de un juego
 * ******************
 * Comentarios: obtiene los detalles de un juego
 * Entrada: el id del juego
 * Salidas: un array
 * Precondiciones: ninguna
 * Postcondiciones: el array estara relleno con el juego que le pasamos la id
 *
 */
function getGamesDetail($idUser){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT * FROM T_Games JOIN T_Usuarios_Games ON T_Usuarios_Games.Game = T_Games.Id WHERE T_Usuarios_Games.Usuario= '$idUser'";

    $result = $conn->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = $row;
    }

    return $arr;
}