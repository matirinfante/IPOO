<?php

require_once 'Modelos/FuncionTeatral.php';

class ABM_Teatral
{
    public static function altaTeatral($idfuncion, $nombre, $horaInicio, $duracion, $precio, &$unTeatro)
    {
        $idInsercion = -1;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'objteatro' => $unTeatro);
        $nuevoTeatral = new FuncionTeatral();
        $nuevoTeatral->cargar($arr);

        $teatroVinculado = new Teatro();

        if ($teatroVinculado->insertarFuncion($nuevoTeatral)) {
            $nuevoTeatral->insertar();
            $idInsercion = $nuevoTeatral->getIdfuncion();
        }

        return $idInsercion;
    }

    public static function bajaTeatral($idfuncion)
    {
        $teatralEliminar = new FuncionTeatral();
        if ($teatralEliminar->buscar($idfuncion)) {
            $teatralEliminar->eliminar();
        }
    }

    public static function modificarTeatral($idfuncion, $nombre, $horaInicio, $duracion, $precio, $unTeatro)
    {
        $exito = false;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'unTeatro' => $unTeatro);
        $teatroVinculado = $unTeatro;

        $funcionModificar = new FuncionTeatral();
        if ($funcionModificar->buscar($idfuncion)) {
            if ($teatroVinculado->verificarHorario($horaInicio, $duracion)) {
                $funcionModificar->cargar($arr);
                $exito = $funcionModificar->modificar();
            }
        }
        return $exito;
    }
}