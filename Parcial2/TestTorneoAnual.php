<?php
include "Equipo.php";
include "Partido.php";
include "MinisterioDeporte.php";
include "Categoria.php";

function main()
{
    $categoria = new Categoria(1, "fulbito");
    $objE1 = new Equipo("E1", "Pepe", "11", $categoria);
    $objE2 = new Equipo("E2", "Pepe", "11", $categoria);
    $objE3 = new Equipo("E3", "Pepe", "11", $categoria);
    $objE4 = new Equipo("E4", "Pepe", "11", $categoria);
    $objE5 = new Equipo("E5", "Pepe", "11", $categoria);
    $objE6 = new Equipo("E6", "Pepe", "11", $categoria);
    $objE7 = new Equipo("E7", "Pepe", "11", $categoria);
    $objE8 = new Equipo("E8", "Pepe", "11", $categoria);
    $objE9 = new Equipo("E9", "Pepe", "11", $categoria);
    $objE10 = new Equipo("E10", "Pepe", "11", $categoria);
    $objE11 = new Equipo("E11", "Pepe", "11", $categoria);
    $objE12 = new Equipo("E12", "Pepe", "11", $categoria);


    $objPart1 = new Partido(1, "", 80, $objE7, 120, $objE8);
    $objPart2 = new Partido(2, "", 81, $objE9, 110, $objE10);
    $objPart3 = new Partido(3, "", 115, $objE11, 85, $objE12);
    $objPart4 = new Partido(4, "", 3, $objE1, 2, $objE2);
    $objPart5 = new Partido(5, "", 0, $objE3, 1, $objE4);
    $objPart6 = new Partido(6, "", 2, $objE5, 3, $objE6);


    $colProv = array($objPart1, $objPart1, $objPart1);
    $colNac = array($objPart4, $objPart5, $objPart6);

    $ministerioDeporte = new MinisterioDeporte(2021);
    //echo $ministerioDeporte;

    $arrayAssoc = array('idTorneo' => "1", 'montoPremio' => 5000, 'localidad' => "chos malal", "provincia" => "neuquen");
    $arrayAssoc2 = array('idTorneo' => "2", 'montoPremio' => 10000, 'localidad' => "chos malal2");

    $torneo5 = $ministerioDeporte->registrarTorneo($colProv, "provincial", $arrayAssoc);
    echo $torneo5;
    $torneo6 = $ministerioDeporte->registrarTorneo($colNac, "nacional", $arrayAssoc2);
    echo $torneo6;

    $premios5 = $ministerioDeporte->otorgarPremioTorneo($torneo5->getIdTorneo());
    $premios6 = $ministerioDeporte->otorgarPremioTorneo($torneo6->getIdTorneo());

    echo $premios5;
    echo $premios6;

    echo $ministerioDeporte;


}


main();

