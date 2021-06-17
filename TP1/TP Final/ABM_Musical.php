<?php

require_once 'Modelos/Musical.php';

class ABM_Musical
{
    public static function altaMusical($idfuncion, $nombre, $horaInicio, $duracion, $precio, &$unTeatro, $director, $cantPersonas)
    {
        $idInsertado = -1;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'objteatro' => $unTeatro, 'director' => $director, 'cantidad_personas' => $cantPersonas);
        $nuevomusical = new Musical();
        $nuevomusical->cargar($arr);

        $teatroVinculado = new Teatro();

        if ($teatroVinculado->insertarFuncion($nuevomusical)) {
            $nuevomusical->insertar();
            $idInsertado = $nuevomusical->getIdfuncion();
        }

        return $idInsertado;
    }

    public static function bajaMusical($idfuncion)
    {
        $musicalEliminar = new Musical();
        if ($musicalEliminar->buscar($idfuncion)) {
            $musicalEliminar->eliminar();
        }
    }

    public static function modificarMusical($idfuncion, $nombre, $horaInicio, $duracion, $precio, $unTeatro, $director, $cantPersonas)
    {
        $exito = false;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'objteatro' => $unTeatro, 'director' => $director, 'cantidad_personas' => $cantPersonas);
        $teatroVinculado = $unTeatro;
        $funcionModificar = new Musical();

        if ($funcionModificar->buscar($idfuncion)) {
            if ($teatroVinculado->verificarHorario($horaInicio, $duracion)) {
                $funcionModificar->cargar($arr);
                $exito = $funcionModificar->modificar();
            }
        }
        return $exito;
    }
}