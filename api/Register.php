<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$nick = $_POST['nick'];
$password = $_POST['password'];
$name = $_POST['name'];

/*echo "nick: ".$nick;
echo "pass: ".$password;
echo "name: ".$name;*/

if(count(existUser($nick,$password))<1) {
    echo json_encode(insertarUsuario($nick, $password, $name));
}else{
    $res = new Response();
    $res->setStatus(404);
    $res->setMessage("Username o Password no disponible");
    echo json_encode($res);
}

/**
 * Funcion para insertar un usuario en la base de datos
 * ******************
 * Comentarios: inserta un usuario
 * Entrada: un Usuario,pass y un username
 * Salidas: un tipo response
 * Precondiciones: el usuario y la pass tienen que estar llenos y que no exista ese usuario en la base de datos
 * Postcondiciones: el tipo response tendra un codigo 200 si se ha insertado correctamente o un codigo 404 si no se ha insertado
 *
 */
function insertarUsuario($nick, $pass, $name) {
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "INSERT INTO T_Usuarios(Nick,Pass,Nombre) VALUES (:nick,:pass,:name)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);


    if ($stmt->execute() === TRUE) {
        $res = new Response();
        $res->setStatus(200);
        $res->setMessage("Usuario registrado correctamente");
    } else {
        $res = new Response();
        $res->setStatus(404);
        $res->setMessage("Error en la BD");
    }
    return $res;
}

/**
 * Existe Usuario
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