<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$idUser = $_POST['iduser'];
$name = $_POST['namegame'];
$buyprice = $_POST['buyprice'];
$datebuy = $_POST['datebuy'];
$consoleId = $_POST['consoleid'];
//Obtener Imagen
$base = $_POST['cover'];

$idGame = insertGame($name,$buyprice,$datebuy,$consoleId);
if($base!=null){
    $binary=base64_decode($base);
    file_put_contents(__DIR__ ."/../uploadIMG/coverGames/".$idGame.".JPG",$binary);
}
echo json_encode( insertGameUser($idGame,$idUser));

/**
 * InsertGame
 * ************************
 * Comentarios: Inserta un juego en la base de datos
 * Entradas: nombre, precio de compra, dia de compra, id de la consola
 * Salidas: devuelve la id del juego insertado
 * Precondiciones: ninguna
 * Postcondiciones: la id correspondiente al juego insertado
 */
function insertGame($name,$buyprice,$datebuy,$consoleId){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "INSERT INTO T_Games( Titulo, PrecioCompra, FechaCompra,Consola) VALUES (:name,:buyprice,:datebuy,:consoleId)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':buyprice', $buyprice, PDO::PARAM_STR);
    $stmt->bindParam(':datebuy', $datebuy, PDO::PARAM_STR);
    $stmt->bindParam(':consoleId', $consoleId, PDO::PARAM_STR);

    $stmt->execute();

    $res = $conn ->lastInsertId();
    return $res;
}

/**
 * InsertGameUser
 * ************************
 * Comentarios: Establece la relacion entre un juego y un usuario
 * Entradas: idGame
 * Salidas: unResponse
 * Precondiciones: ninguna
 * Postcondiciones: se devolvera una respuesta de 200 si se ha realizado o una 404 si no
 */
function insertGameUser($idGame, $idUser){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "INSERT INTO `T_Usuarios_Games`(`Usuario`, `Game`) VALUES (:idUser,:idGame)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idGame', $idGame, PDO::PARAM_STR);
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);


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