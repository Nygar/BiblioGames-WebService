<?php

/**
 * Clase usada especificamente para componer objetos usando las filas de las tablas de una BD
 */
function obtenerUsuario($row){
    $user = new Usuario();
    $user->setId($row['IDUsuario']); //Añadimos ID
    $user->setNick($row['Nick']); //Añadimos Nick
    $user->setName($row['NombreUsuario']); //Añadimos Nombre
    $user->setPass($row['Pass']);

    return $user;
}

function obtenerGame($row){
    $game = new Games();
    $game->setId($row['IDUsuario']);
    $game->setTitle($row['Nick']);
    $game->setBuyprice($row['NombreUsuario']);
    $game->setBuydate($row['Pass']);
    $game->setConsole($row['Pass']);

    return $game;
}

function obtenerConsole($row){
    $console = new Console();
    $console->setId($row['IdConsole']);
    $console->setName($row['NameConsole']);
    $console->setDateRelase($row['T_Console.FechaFabricacion']);

    return $console;
}
