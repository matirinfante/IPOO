<?php
include "Teatro.php";

/**
 * @param $cargado
 * @param $unTeatro
 */
function menu($cargado, &$unTeatro)
{
    do {
        $opcion = -1;
        echo "---- ADMIN DE TEATRO ----\n";
        echo "Seleccione una opción:\n";
        if ($cargado) {
            do {
                echo "1) Modificar datos\n";
                echo "2) Mostrar datos\n";
                echo "3) Salir\n";
                $opcion = trim(fgets(STDIN));
                switch ($opcion) {
                    case 1:
                        modificarDatos($unTeatro);
                        break;
                    case 2:
                        mostrarDatos($unTeatro);
                        break;
                    default:
                        echo "Ingrese una opción correcta\n";
                }
            } while ($opcion <> 3);
        } else {
            do {
                echo "1) Para cargar información al teatro\n";
                echo "2) Salir\n";
                $opcion = trim(fgets(STDIN));
                if ($opcion < 1 || $opcion > 2) {
                    echo "Ingrese una opción válida\n";
                }
            } while ($opcion <> 1 and $opcion <> 2);
            if ($opcion == 1) {
                $cargado = cargaDatos($unTeatro);
            }
        }
    } while ($opcion <> 2 and $opcion <> 3);
}

/**
 * @param $unTeatro
 * @return bool
 */
function cargaDatos(&$unTeatro)
{
    $nombreTeatro = "";
    $direccionTeatro = "";
    $nombreFuncion = "";
    $precioFuncion = -1;
    $exito = false;
    echo "*** CARGA DATOS TEATRO ***\n";
    echo "Ingrese el nombre del teatro:\n";
    $nombreTeatro = trim(fgets(STDIN));
    echo "Ingrese la dirección del teatro:\n";
    $direccionTeatro = trim(fgets(STDIN));
    echo "\nSe procederá a realizar la carga de las 4 funciones del teatro.\n";
    $unTeatro->setNombre($nombreTeatro);
    $unTeatro->setDireccion($direccionTeatro);

    for ($i = 0; $i < 4; $i++) {
        echo "Ingrese el nombre de la función " . ($i + 1) . ":\n";
        $nombreFuncion = trim(fgets(STDIN));
        do {
            echo "Ingrese el precio:\n";
            $precioFuncion = trim(fgets(STDIN));
            if (!is_numeric($precioFuncion)) {
                echo "Ingrese un número \n";
            }
        } while (!is_numeric($precioFuncion));
        $unTeatro->setFuncion($i, $nombreFuncion, $precioFuncion);
    }

    $exito = true;
    return $exito;
}

/**
 * @param $unTeatro
 */
function modificarDatos($unTeatro)
{
    $opcionMod = -1;
    do {
        echo "*** MODIFICAR DATOS TEATRO ***\n";
        echo "Seleccione una opción:\n";
        echo "1) Cambiar nombre del teatro\n";
        echo "2) Cambiar dirección del teatro\n";
        echo "3) Modificar funciones activas\n";
        echo "4) Volver al menú anterior\n";
        $opcionMod = trim(fgets(STDIN));
        switch ($opcionMod) {
            case 1:
                modificarTeatro($unTeatro);
                break;
            case 2:
                modificarDireccion($unTeatro);
                break;
            case 3:
                modificarFunciones($unTeatro);
                break;
            default:
                echo "Ingrese una opción correcta\n";
        }
    } while ($opcionMod <> 4);
}

/**
 * @param $unTeatro
 */
function modificarTeatro(&$unTeatro)
{
    echo "--- MODIFICAR NOMBRE TEATRO ---\n";
    echo "Ingrese un nombre: \n";
    $nombreIngresado = trim(fgets(STDIN));
    $unTeatro->setNombre($nombreIngresado);
}

/**
 * @param $unTeatro
 */
function modificarDireccion(&$unTeatro)
{
    echo "--- MODIFICAR DIRECCION TEATRO ---\n";
    echo "Ingrese una dirección: \n";
    $direccionIngresado = trim(fgets(STDIN));
    $unTeatro->setDireccion($direccionIngresado);
}

/**
 * @param $unTeatro
 */
function modificarFunciones(&$unTeatro)
{
    $numeroFuncion = -1;
    $nombreFuncion = "";
    $precioFuncion = "";
    do {
        echo "--- MODIFICAR FUNCIONES ---\n";
        echo "Ingrese el numero de función a modificar: \n";
        $numeroFuncion = trim(fgets(STDIN));
        if ($numeroFuncion < 1 || $numeroFuncion > 4) {
            echo "Ingrese un número de función válido (entre 1 y 4)\n";
        }
    } while ($numeroFuncion < 1 || $numeroFuncion > 4);
    echo "Ingrese el nombre de la función: \n";
    $nombreFuncion = trim(fgets(STDIN));
    do {
        echo "Ingrese el precio de la función \n";
        $precioFuncion = trim(fgets(STDIN));
        if (!is_numeric($precioFuncion)) {
            echo "Ingrese un número.\n";
        }
    } while (!is_numeric($numeroFuncion));

    $unTeatro->setFuncion($numeroFuncion - 1, $nombreFuncion, $precioFuncion);
}

/**
 * @param $unTeatro
 */
function mostrarDatos($unTeatro)
{
    echo $unTeatro->__toString();
}

/**
 *
 */
function main()
{

    $unTeatro = new Teatro();
    $cargado = false;
    menu($cargado, $unTeatro);
}


main();
