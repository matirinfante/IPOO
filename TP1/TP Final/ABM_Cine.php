<?php

require_once('Modelos/Cine.php');

class ABM_Cine
{
    public static function altaCine($idfuncion, $nombre, $horaInicio, $duracion, $precio, &$unTeatro, $genero, $paisOrigen)
    {
        $idInsertado = -1;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'objteatro' => $unTeatro, 'genero' => $genero, 'pais_origen' => $paisOrigen);
        $nuevoCine = new Cine();
        $nuevoCine->cargar($arr);
        $teatroVinculado = $unTeatro;

        if ($teatroVinculado->insertarFuncion($nuevoCine)) {
            $nuevoCine->insertar();
            $idInsertado = $nuevoCine->getIdfuncion();
        }

        return $idInsertado;
    }

    public static function bajaCine($idfuncion)
    {
        $cineEliminar = new Cine();
        if ($cineEliminar->buscar($idfuncion)) {
            $cineEliminar->eliminar();
        }
    }

    public static function modificarCine($idfuncion, $nombre, $horaInicio, $duracion, $precio, &$unTeatro, $genero, $paisOrigen)
    {
        $exito = false;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'objteatro' => $unTeatro, 'genero' => $genero, 'pais_origen' => $paisOrigen);
        $teatroVinculado = $unTeatro;
        $funcionModificar = new Cine();

        if ($funcionModificar->buscar($idfuncion)) {
            if ($teatroVinculado->verificarHorario($horaInicio, $duracion)) {
                $funcionModificar->cargar($arr);
                $exito = $funcionModificar->modificar();
            }
        }
        return $exito;
    }
}