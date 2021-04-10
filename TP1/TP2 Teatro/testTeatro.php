<?php
include "Teatro.php";

/**
 * Autor: Matias Infante
 * Para la materia IPOO de la carrera TUDW de la Universidad Nacional del Comahue.
 *
 * La funcionalidad del script está pensada para orientarla al ingreso de datos del usuario, simula a un Teatro con funciones organizadas en un arreglo dinámico, en horarios distintos
 * que no se deben superponer.
 */


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
    $salir = false;
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

    while (!$salir) {
        do {

            echo "Ingrese el nombre de la función a agregar:\n";
            $nombreFuncion = trim(fgets(STDIN));
            $nombreRepetido = $unTeatro->buscarCoincidencias($nombreFuncion);
            if ($nombreRepetido) {
                echo "La función que intenta agregar ya se encuentra en cartelera!\nIntente nuevamente";
            }
        } while ($nombreRepetido);

        do {
            echo "Ingrese el precio:\n";
            $precioFuncion = trim(fgets(STDIN));
            if (!is_numeric($precioFuncion)) {
                echo "Ingrese un número \n";
            }
        } while (!is_numeric($precioFuncion));

        do {
            echo "Ingrese el horario (HH:MM):\n";
            $horaInicio = trim(fgets(STDIN));
            if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $horaInicio)) {
                echo "Ingrese un formato de hora válido.\n";
            }
        } while (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $horaInicio));

        do {
            echo "Ingrese el duracion (en minutos):\n";
            $duracion = trim(fgets(STDIN));
            if (!is_numeric($precioFuncion)) {
                echo "Ingrese un número \n";
            }
        } while (!is_numeric($precioFuncion));
        if (!$unTeatro->insertarFuncion($nombreFuncion, $precioFuncion, $horaInicio, $duracion)) {
            echo "No pudo agregarse la función ya que el horario se superpone con otra función existente\n";
        }
        echo "¿Desea continuar agregando funciones? Ingrese 1, caso contrario ENTER\n";
        $salir = trim(fgets(STDIN)) != 1;

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
function modificarDireccion(Teatro &$unTeatro)
{
    echo "--- MODIFICAR DIRECCION TEATRO ---\n";
    echo "Ingrese una dirección: \n";
    $direccionIngresado = trim(fgets(STDIN));
    $unTeatro->setDireccion($direccionIngresado);
}

/**
 * @param $unTeatro
 */
function modificarFunciones(Teatro &$unTeatro)
{
    $numeroFuncion = -1;

    do {
        echo "--- MODIFICAR FUNCIONES ---\n";
        echo "Actualmente el teatro cuenta con las siguientes funciones:\n";
        echo $unTeatro->mostrarFunciones();
        echo "Ingrese el nombre de la función a modificar: \n";
        $nombreFuncion = strtolower(trim(fgets(STDIN)));
    } while (!$unTeatro->buscarCoincidencias($nombreFuncion));

    echo "Ingrese el nuevo nombre de la función: \n";
    $nuevoNombre = trim(fgets(STDIN));
    do {
        echo "Ingrese el nuevo precio de la función \n";
        $precioFuncion = trim(fgets(STDIN));
        if (!is_numeric($precioFuncion)) {
            echo "Ingrese un número.\n";
        }
    } while (!is_numeric($numeroFuncion));

    $unTeatro->setFuncion($nombreFuncion, $nuevoNombre, $precioFuncion);
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
