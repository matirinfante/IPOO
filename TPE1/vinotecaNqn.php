<?php
/**
 * Autor: Matias Ricardo Infante Contreras
 * Legajo: FAI-1392
 */


/** CalcStock se encarga de, en base a un arreglo dado, crear otro arreglo con el stock total de botellas y el promedio de precios total.
 * @param $array , un arreglo asociativo representando a la vinoteca
 * @return array $calcVinos arreglo conteniendo el stock total de botellas y precio promedio total por cada variedad.
 */
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

/**
 *Carga de la estructura vinoteca y muestra por consola del arreglo resultante en calcStock.
 */
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