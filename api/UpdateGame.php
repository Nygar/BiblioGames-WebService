<?php
require_once __DIR__ . '/../model/Conector.php';
require_once __DIR__ . '/../model/Response.php';

$idGame = $_POST['idgame'];
$name = $_POST['namegame'];
$buyprice = $_POST['buyprice'];
$datebuy = $_POST['datebuy'];
$consoleId = $_POST['consoleid'];
//Obtener Imagen
$base = $_POST['cover'];
if($base!=null){
    $binary=base64_decode($base);
    file_put_contents(__DIR__ ."/../uploadIMG/coverGames/".$idGame.".JPG",$binary);
}
echo json_encode( updateGame($idGame,$name,$buyprice,$datebuy,$consoleId));
/**
 * UpdateGameUser
 * ************************
 * Comentarios: Actualiza un juego
 * Entradas: el id game, y los datos a actualizar
 * Salidas: unResponse
 * Precondiciones: ninguna
 * Postcondiciones: se devolvera una respuesta de 200 si se ha realizado o una 404 si no
 */
function updateGame($idGame,$name,$buyprice,$datebuy,$consoleId){
    $db = new Conector();
    $conn = $db->getNewConnection();
    $sql = "UPDATE `T_Games` SET `Titulo`=:name,`PrecioCompra`=:buyprice,`FechaCompra`=:dateBuy,`Consola`=:consoleId WHERE `Id`=:idGame";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idGame', $idGame, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':buyprice', $buyprice, PDO::PARAM_STR);
    $stmt->bindParam(':dateBuy', $datebuy, PDO::PARAM_STR);
    $stmt->bindParam(':consoleId', $consoleId, PDO::PARAM_STR);


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