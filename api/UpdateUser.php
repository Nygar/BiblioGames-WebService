<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$idUser = $_POST['user_id'];
$nick = $_POST['nick'];
$password = $_POST['password'];
$name = $_POST['name'];

//Obtener Imagen
$base = $_POST['avatar'];
if($base!=null){
    $binary=base64_decode($base);
    file_put_contents(__DIR__ ."/../uploadIMG/avatar/".$idUser.".JPG",$binary);
}
echo json_encode( updateUser($idUser,$nick,$password,$name));
/**
 * UpdateUser
 * ************************
 * Comentarios: Actualiza un usuario
 * Entradas: el id del usuario, y los datos a actualizar
 * Salidas: unResponse
 * Precondiciones: ninguna
 * Postcondiciones: se devolvera una respuesta de 200 si se ha realizado o una 404 si no
 */
function updateUser($idUser,$nick,$password,$name){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "UPDATE `T_Usuarios` SET `Nick`=:nick,`Pass`=:password,`Nombre`=:name WHERE `Id`= :idUser";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
    $stmt->bindParam(':nick', $nick, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

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