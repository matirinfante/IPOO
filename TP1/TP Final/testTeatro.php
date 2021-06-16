<?php
require_once "Modelos/Teatro.php";
require_once "ABM_Teatro.php";
require_once "ABM_Musical.php";
require_once "ABM_Cine.php";
require_once "ABM_Teatral.php";


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
function menu()
{
    do {
        $opcionTeatro = -1;
        echo "1) Ver y administrar teatros \n";
        echo "2) Agregar teatro\n";
        echo "3) Eliminar teatro\n";
        echo "4) Salir.\n";

        $opcionTeatro = trim(fgets(STDIN));
        switch ($opcionTeatro) {
            case 1:
                mostrarTeatros();
                break;
            case 2:
                agregarTeatro();
                break;
            case 3:
                eliminarTeatro();
                break;
            case 4:
                echo "//// SALIENDO ////\n";
            default:
                echo "Ingrese una opción válida";
                break;
        }
    } while ($opcionTeatro <> 4);
}

function mostrarTeatros()
{
    $unTeatro = new Teatro();
    $resp = false;
    do {
        $idteatro = -1;
        echo "//// TEATROS DISPONIBLES ////\n";
        $cantTeatros = listaTeatros();

        if ($cantTeatros != 0) {
            do {
                echo "Seleccione un teatro:\n";
                $idteatro = trim(fgets(STDIN));
                $resp = $unTeatro->buscar($idteatro);
            } while (!$resp);
            administrarTeatro($unTeatro);
        } else {
            do {
                echo "//// ALTA TEATRO ////\n";
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
    } while (!$resp);

}

function agregarTeatro()
{
    do {
        echo "//// ALTA TEATRO ////\n";
        echo "1) Para cargar información de teatro\n";
        echo "2) Salir\n";
        $opcion = trim(fgets(STDIN));
        if ($opcion < 1 || $opcion > 2) {
            echo "Ingrese una opción válida\n";
        }
    } while ($opcion <> 1 and $opcion <> 2);
    if ($opcion == 1) {
        cargaDatos();
    }
}

function eliminarTeatro()
{
    $unTeatro = new Teatro();
    do {
        echo "//// BAJA TEATRO ////\n";
        $idteatro = -1;
        $cantTeatros = listaTeatros();
        $seguir = -1;
        if ($cantTeatros != 0) {
            do {
                echo "Seleccione un teatro o 0(cero) para salir:\n";
                $idteatro = trim(fgets(STDIN));
                $resp = $unTeatro->buscar($idteatro);
                $seguir = $idteatro;
            } while (!$resp && $seguir <> 0);
            ABM_Teatro::eliminarTeatro($idteatro);
        } else {
            echo "NO HAY TEATROS PARA ELIMINAR... REGRESANDO\n";
            $seguir = 0;
        }
    } while ($seguir <> 0);
}

function administrarTeatro(&$unTeatro)
{
    $opcion = -1;
    echo "---- ADMIN DE TEATROS ----\n";
    echo "Seleccione una opción:\n";
    do {
        $idteatro = $unTeatro->getIdTeatro();
        $unTeatro->buscar($idteatro);
        echo "1) Modificar datos\n";
        echo "2) Mostrar datos\n";
        echo "3) Calcular costos\n";
        echo "4) Salir\n";
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1:
                modificarDatos($unTeatro);
                break;
            case 2:
                mostrarDatos($unTeatro);
                break;
            case 3:
                echo "Costo total: {$unTeatro->darCosto()}\n";
                break;
            default:
                echo "Ingrese una opción correcta\n";
        }
    } while ($opcion <> 4);
}

function listaTeatros()
{
    $teatroTemp = new Teatro();
    $teatros = $teatroTemp->listar();
    $cantidadTeatros = count($teatros);
    if ($cantidadTeatros <> 0) {
        foreach ($teatros as $teatro) {
            print $teatro->__toString();
            echo "*** ---- ***\n";
        }
    } else {
        echo "NO HAY TEATROS CARGADOS!\n";
    }
    return $cantidadTeatros;
}

/**
 * @param $unTeatro
 * @return bool
 */
function cargaDatos()
{
    $unTeatro = new Teatro();
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
    echo "\nSe procederá a realizar la carga de las funciones del teatro.\n";

    $idteatro = ABM_Teatro::altaTeatro($nombreTeatro, $direccionTeatro);
    $unTeatro->buscar($idteatro);

    while (!$salir) {
        agregarFuncion($unTeatro, $idteatro);
        echo "¿Desea continuar agregando funciones? Ingrese 1, caso contrario ENTER\n";
        $salir = trim(fgets(STDIN)) != 1;
    }

    $exito = true;
    return $exito;
}

/**
 * @param $unTeatro
 */
function modificarDatos(&$unTeatro)
{
    $opcionMod = -1;
    do {
        echo "*** MODIFICAR DATOS TEATRO ***\n";
        echo "Seleccione una opción:\n";
        echo "1) Cambiar datos teatro\n";
        echo "2) Agregar funcion a este teatro\n";
        echo "3) Modificar funciones activas\n";
        echo "4) Eliminar funcion\n";
        echo "5) Volver al menú anterior\n";
        $opcionMod = trim(fgets(STDIN));
        switch ($opcionMod) {
            case 1:
                modificarTeatro($unTeatro);
                break;
            case 2:
                agregarFuncion($unTeatro, $unTeatro->getIdTeatro());
                break;
            case 3:
                modificarFunciones($unTeatro);
                break;
            case 4:
                eliminarFuncion($unTeatro);
                break;
            default:
                echo "Ingrese una opción correcta\n";
        }
    } while ($opcionMod <> 5);
}

/**
 * @param $unTeatro
 */
function modificarTeatro(&$unTeatro)
{
    echo "--- MODIFICAR NOMBRE TEATRO ---\n";
    echo "Ingrese un nombre: \n";
    $nombreIngresado = trim(fgets(STDIN));
    echo "--- MODIFICAR DIRECCION TEATRO ---\n";
    echo "Ingrese una dirección: \n";
    $direccionIngresado = trim(fgets(STDIN));
    ABM_Teatro::modificarTeatro($unTeatro->getIdTeatro(), $nombreIngresado, $direccionIngresado);
}

function agregarFuncion(&$unTeatro, $idteatro)
{
    echo "//// ALTA FUNCION ////\n";
    do {
        echo "Ingrese el nombre de la función a agregar:\n";
        $nombreFuncion = trim(fgets(STDIN));
        $nombreRepetido = $unTeatro->buscarCoincidencias($nombreFuncion);
        if ($nombreRepetido) {
            echo "La función que intenta agregar ya se encuentra en cartelera!\nIntente nuevamente";
        }
    } while ($nombreRepetido);
    do {
        echo "Ingrese el tipo de función a agregar: (CINE, MUSICAL, TEATRO) \n";
        $tipo = strtolower(trim(fgets(STDIN)));
        $sigue = $tipo == "cine" || $tipo == "musical" || $tipo == "teatro";
    } while (!$sigue);
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
        if (!is_numeric($duracion)) {
            echo "Ingrese un número \n";
        }
    } while (!is_numeric($duracion));
    switch ($tipo) {
        case "teatro":
            $idInsertado = ABM_Teatral::altaTeatral(0, $nombreFuncion, $horaInicio, $duracion, $precioFuncion, $idteatro);
            break;
        case "cine":
            echo "Ingrese el pais de origen:\n";
            $pais = trim(fgets(STDIN));
            echo "Ingrese el genero:\n";
            $genero = trim(fgets(STDIN));
            $idInsertado = ABM_Cine::altaCine(0, $nombreFuncion, $horaInicio, $duracion, $precioFuncion, $idteatro, $genero, $pais);
            break;
        case "musical":
            echo "Ingrese el director:\n";
            $director = trim(fgets(STDIN));
            echo "Ingrese la cantidad de espectadores:\n";
            $espectadores = trim(fgets(STDIN));
            $idInsertado = ABM_Musical::altaMusical(0, $nombreFuncion, $horaInicio, $duracion, $precioFuncion, $idteatro, $director, $espectadores);
            break;
    }
    if ($idInsertado == -1) {
        echo "No pudo agregarse la función ya que el horario se superpone con otra función existente en el teatro\n";
    }
}

function eliminarFuncion(&$unTeatro)
{
    echo "//// BAJA FUNCION ////\n";
    echo $unTeatro->mostrarFunciones();
    echo "Seleccione id de la función a eliminar:\n";
    $idfuncion = trim(fgets(STDIN));
    if ($unTeatro->buscarCoincidencias($idfuncion)) {
        $unaFuncion = $unTeatro->buscarFuncion($idfuncion);
        switch (get_class($unaFuncion)) {
            case "Cine":
                ABM_Cine::bajaCine($idfuncion);
                break;
            case "Musical":
                ABM_Musical::bajaMusical($idfuncion);
                break;
            case "FuncionTeatral":
                ABM_Teatral::bajaTeatral($idfuncion);
        }
    } else {
        echo "Funcion inexistente\n";
    }
}

/**
 * @param $unTeatro
 */
function modificarFunciones(&$unTeatro)
{
    $nuevoNombre = "";
    $precioFuncion = 0;
    $horaInicio = "";
    $duracion = 0;

    do {
        echo "--- MODIFICAR FUNCIONES ---\n";
        echo "Actualmente el teatro cuenta con las siguientes funciones:\n";
        echo $unTeatro->mostrarFunciones();
        echo "Ingrese el id de la función a modificar: \n";
        $idfuncion = strtolower(trim(fgets(STDIN)));
    } while (!$unTeatro->buscarCoincidencias($idfuncion));

    echo "Ingrese el nuevo nombre de la función: \n";
    $nuevoNombre = trim(fgets(STDIN));
    do {
        echo "Ingrese el nuevo precio de la función \n";
        $precioFuncion = trim(fgets(STDIN));
        if (!is_numeric($precioFuncion)) {
            echo "Ingrese un número.\n";
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
        if (!is_numeric($duracion)) {
            echo "Ingrese un número \n";
        }
    } while (!is_numeric($duracion));

    $unaFuncion = $unTeatro->buscarFuncion($idfuncion);

    $exito = false;
    switch (get_class($unaFuncion)) {
        case "Cine":
            echo "Ingrese el pais de origen:\n";
            $pais = trim(fgets(STDIN));
            echo "Ingrese el genero:\n";
            $genero = trim(fgets(STDIN));
            $exito = ABM_Cine::modificarCine($idfuncion, $nuevoNombre, $horaInicio, $duracion, $precioFuncion, $unTeatro->getIdTeatro(), $pais, $genero);
            break;
        case "Musical":
            echo "Ingrese el director:\n";
            $director = trim(fgets(STDIN));
            echo "Ingrese la cantidad de espectadores:\n";
            $espectadores = trim(fgets(STDIN));
            $exito = ABM_Musical::modificarMusical($idfuncion, $nuevoNombre, $horaInicio, $duracion, $precioFuncion, $unTeatro->getIdTeatro(), $director, $espectadores);
            break;
        case "FuncionTeatral":
            $exito = ABM_Teatral::modificarTeatral($idfuncion, $nuevoNombre, $horaInicio, $duracion, $precioFuncion, $unTeatro->getIdTeatro());
    }
    if (!$exito) {
        echo "No se modificó la función porque el horario se superponía con una función existente\n";
    }
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
    menu();
}


main();
