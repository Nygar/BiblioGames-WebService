<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../util/Mapper.php';

$id = $_GET['user_id'];
echo json_encode( getFriends($id));
/**
 * Funcion para obtener los amigos de un usuario
 * ******************
 * Comentarios: obtiene los amigos de un usuario
 * Entrada: el id del usuario
 * Salidas: un array
 * Precondiciones: ninguna
 * Postcondiciones: el array de salida contendra los usuarios que son amigos del usuario de entrada,
 * se devolvera el array vacio si no tiene amigos
 *
 */
function getFriends($idUser){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT DISTINCT * FROM  T_Amigos JOIN T_Usuarios ON T_Usuarios.Id = T_Amigos.Usuario1 || T_Usuarios.Id = T_Amigos.Usuario2
        WHERE (T_Amigos.Usuario1='$idUser' || T_Amigos.Usuario2='$idUser') && T_Usuarios.Id!='$idUser'";

    $result = $conn->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = array('id' => $row['Id'], 'name'=>$row['Nombre']);
    }

    return $arr;
}