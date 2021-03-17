<?php

function cargarArray()
{
    $vinoteca = array();

    $vinoteca['Malbec'] = array(
        array("cantidad" => 85, "anio" => "1999", "precio" => 240),
        array("cantidad" => 64, "anio" => "2003", "precio" => 150)
    );
    $vinoteca['Merlot'] = array(
        array("cantidad" => 82, "anio" => "2003", "precio" => 250),
        array("cantidad" => 50, "anio" => "1975", "precio" => 1500)
    );

    $vinoteca['Cabernet Sauvignon'] = array(
        array("cantidad" => 2, "anio" => "2008", "precio" => 270),
        array("cantidad" => 54, "anio" => "2014", "precio" => 500)
    );

    return $vinoteca;
}

function calcStock($array)
{
    $calcVinos = array();
    foreach ($array as $variedad => $vinoVariedad) {
        $stockVinos = 0;
        $precioTotalPromedio = 0;
        foreach ($vinoVariedad as $vino) {
            $stockVinos = $stockVinos + $vino['cantidad'];
            $precioTotalPromedio = $precioTotalPromedio + ($vino['precio'] * $vino['cantidad']);
        }
        $calcVinos[$variedad] = array("cantStock" => $stockVinos, "precioTotalPromedio" => $precioTotalPromedio / $stockVinos);
    }
    return $calcVinos;
}

function main()
{
    $vinoteca = array();

    $vinoteca['Malbec'] = array(
        array("cantidad" => 85, "anio" => "1999", "precio" => 240),
        array("cantidad" => 64, "anio" => "2003", "precio" => 150)
    );
    $vinoteca['Merlot'] = array(
        array("cantidad" => 82, "anio" => "2003", "precio" => 250),
        array("cantidad" => 50, "anio" => "1975", "precio" => 1500)
    );

    $vinoteca['Cabernet Sauvignon'] = array(
        array("cantidad" => 2, "anio" => "2008", "precio" => 270),
        array("cantidad" => 54, "anio" => "2014", "precio" => 500)
    );

    print_r(calcStock($vinoteca));
}

main();