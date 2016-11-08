<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../util/Mapper.php';

$id = $_GET['user_id'];
echo json_encode( getNoFriends($id));
/**
 * Funcion para obtener los usuarion NO amigos de un usuario
 * ******************
 * Comentarios: obtiene los No amigos de un usuario
 * Entrada: el id del usuario
 * Salidas: un array
 * Precondiciones: ninguna
 * Postcondiciones: el array de salida contendra los usuarios que NO son amigos del usuario de entrada,
 * se devolvera el array vacio si no hay usuarios
 *
 */
function getNoFriends($id){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT * FROM T_Usuarios WHERE Id NOT IN (
SELECT Id FROM  T_Amigos JOIN T_Usuarios ON T_Usuarios.Id = T_Amigos.Usuario1 || T_Usuarios.Id = T_Amigos.Usuario2
 WHERE (T_Amigos.Usuario1='$id' || T_Amigos.Usuario2='$id'))";

    $result = $conn->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $arr[] = array('id' => $row['Id'], 'name'=>$row['Nombre']);
    }

    return $arr;
}