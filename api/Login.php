<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../util/Mapper.php';

$nick = $_POST['nick'];
$password = $_POST['password'];

/*echo "nick: ".$nick;
echo "pass: ".$password;*/

echo json_encode( existUser($nick,$password));

/**
 * Login Usuario
 * ************************
 * Comentarios: Esta funcion comprueba si existe un usuario y su pass en la BD
 * Entradas: Un nick y una pass
 * Salidas: un array
 * Precondiciones: Ni la pass ni el nick puede ser mayor de 10 caracteres
 * Postcondiciones: Se devolvera un array de usuario si este existe o se devolvera vacio si no existe
 */
function existUser($nick,$password){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $arr = array();

    $sql = "SELECT * FROM `T_Usuarios` Where `Nick`= '$nick' && Pass='$password'";

    $result = $conn->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $arr = array('id' => $row['Id'], 'nick' => $row['Nick'],'pass'=>$row['Pass'],'name'=>$row['Nombre']);
        }

    return $arr;
}