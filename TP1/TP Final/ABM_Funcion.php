<?php


class ABM_Funcion
{
    public static function altaFuncion($nombre, $horaInicio, $duracion, $precio, $idteatro)
    {
        $nuevaFuncion = new Funcion();
        $nuevaFuncion->cargar(0, $nombre, $horaInicio, $duracion, $precio, $idteatro);

        $teatroVinculado = new Teatro();
        if ($teatroVinculado->buscar($idteatro)) {
            if ($teatroVinculado->insertarFuncion($nuevaFuncion)) {
                $nuevaFuncion->insertar();
            }
        }
    }

    public static function modificarFuncion($idfuncion, $nombre, $horaInicio, $duracion, $precio, $idteatro)
    {
        $funcionModificar = new Funcion();
        if ($funcionModificar->buscar($idfuncion)) {
            $funcionModificar->setNombre($nombre);
            $funcionModificar->setHoraInicio($horaInicio);
            $funcionModificar->setDuracion($duracion);
            $funcionModificar->setPrecio($precio);
            $funcionModificar->modificar();
        }
    }

    public static function bajaFuncion($idfuncion)
    {
        $funcionEliminar = new Funcion();
        if ($funcionEliminar->buscar($idfuncion)) {
            $funcionEliminar->eliminar();
        }
    }
}