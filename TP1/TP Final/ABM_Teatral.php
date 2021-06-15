<?php

require_once 'Modelos/FuncionTeatral.php';

class ABM_Teatral
{
    public static function altaTeatral($idfuncion, $nombre, $horaInicio, $duracion, $precio, $idteatro)
    {
        $idInsercion = -1;
        $arr = array('idfuncion' => $idfuncion, 'nombre' => $nombre, 'hora_inicio' => $horaInicio, 'duracion' => $duracion, 'precio' => $precio, 'idteatro' => $idteatro);
        $nuevoTeatral = new FuncionTeatral();
        $nuevoTeatral->cargar($arr);

        $teatroVinculado = new Teatro();
        if ($teatroVinculado->buscar($idteatro)) {
            if ($teatroVinculado->insertarFuncion($nuevoTeatral)) {
                $nuevoTeatral->insertar();
                $idInsercion = $nuevoTeatral->getIdfuncion();
            }
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

    public static function modificarTeatral($idfuncion, $nombre, $horaInicio, $duracion, $precio)
    {
        $funcionModificar = new FuncionTeatral();
        if ($funcionModificar->buscar($idfuncion)) {
            $funcionModificar->setNombre($nombre);
            $funcionModificar->setHoraInicio($horaInicio);
            $funcionModificar->setDuracion($duracion);
            $funcionModificar->setPrecio($precio);
            $funcionModificar->modificar();
        }
    }
}