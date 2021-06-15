<?php

require_once('Modelos/Cine.php');

class ABM_Cine
{
    public static function altaCine($idfuncion, $nombre, $horaInicio, $duracion, $precio, $idteatro, $genero, $paisOrigen)
    {
        $idInsertado = -1;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'idteatro' => $idteatro, 'genero' => $genero, 'pais_origen' => $paisOrigen);
        $nuevoCine = new Cine();
        $nuevoCine->cargar($arr);

        $teatroVinculado = new Teatro();
        if ($teatroVinculado->buscar($idteatro)) {
            if ($teatroVinculado->insertarFuncion($nuevoCine)) {
                $nuevoCine->insertar();
                $idInsertado = $nuevoCine->getIdfuncion();
            }
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

    public static function modificarCine($idfuncion, $nombre, $horaInicio, $duracion, $precio, $idteatro, $genero, $paisOrigen)
    {
        $funcionModificar = new Cine();
        if ($funcionModificar->buscar($idfuncion)) {
            $funcionModificar->setNombre($nombre);
            $funcionModificar->setHoraInicio($horaInicio);
            $funcionModificar->setDuracion($duracion);
            $funcionModificar->setPrecio($precio);
            $funcionModificar->setGenero($genero);
            $funcionModificar->setPaisOrigen($paisOrigen);
            $funcionModificar->modificar();
        }
    }
}