<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Console.php';
require_once __DIR__ . '/../model/Games.php';
require_once __DIR__ . '/../util/Mapper.php';

$id = $_GET['user_id'];
echo json_encode( getGraphics($id));
/**
 * Funcion para obtener los graficos de gastos
 * ******************
 * Comentarios: obtiene los gastos de un usuario
 * Entrada: el id del usuario
 * Salidas: un array
 * Precondiciones: ninguna
 * Postcondiciones: el array estara relleno con los gastos del usuario, si no hay ninguno el array estara vacio
 *
 */
function getGraphics($idUser){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT IdConsole,SUM(PrecioCompra) AS Gastado,NameConsole FROM T_Games JOIN T_Usuarios_Games ON T_Usuarios_Games.Game = T_Games.Id
 JOIN T_Consola ON T_Games.Consola=T_Consola.IdConsole
 WHERE T_Usuarios_Games.Usuario= '$idUser' GROUP BY IdConsole, NameConsole ORDER BY FechaCompra DESC ";

    $result = $conn->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = array('id' => $row['IdConsole'], 'gastado' => $row['Gastado'],'name_console'=>$row['NameConsole']);
    }

    return $arr;
}