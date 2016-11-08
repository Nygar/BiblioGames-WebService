<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Console.php';
require_once __DIR__ . '/../model/Games.php';
require_once __DIR__ . '/../util/Mapper.php';

$id = $_GET['id_user'];
echo json_encode( getGames($id));
/**
 * Funcion para obtener los juegos de un usuario
 * ******************
 * Comentarios: obtiene los juegos que posee un usuario
 * Entrada: el id del usuario
 * Salidas: un array
 * Precondiciones: ninguna
 * Postcondiciones: el array estara relleno con los juegos del usuario, si no hay ninguno el array estara vacio
 *
 */
function getGames($idUser){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT * FROM T_Games JOIN T_Usuarios_Games ON T_Usuarios_Games.Game = T_Games.Id
 JOIN T_Consola ON T_Games.Consola=T_Consola.IdConsole
 WHERE T_Usuarios_Games.Usuario= '$idUser' ORDER BY FechaCompra DESC";

    $result = $conn->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = array('id' => $row['Id'], 'titulo' => $row['Titulo'],'precio_compra'=>$row['PrecioCompra'],'fecha_compra'=>$row['FechaCompra'],'consola'=>obtenerConsole($row));
    }

    return $arr;
}