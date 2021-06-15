<?php

require_once('Modelos/Teatro.php');
require_once('Modelos/Funcion.php');

class ABM_Teatro
{
    public static function altaTeatro($nombre, $direccion)
    {
        $nuevoTeatro = new Teatro();
        $nuevoTeatro->cargar(0, $nombre, $direccion);
        $nuevoTeatro->insertar();
    }

    public static function modificarTeatro($idteatro, $nombre, $direccion)
    {
        $teatroModificar = new Teatro();
        $resp = $teatroModificar->buscar($idteatro);

        if ($resp) {
            $teatroModificar->setNombre($nombre);
            $teatroModificar->setDireccion($direccion);
            $teatroModificar->modificar();
        }
    }

    public static function eliminarTeatro($idteatro)
    {
        $teatroEliminar = new Teatro();
        $resp = $teatroEliminar->buscar($idteatro);
        var_dump($resp);

        if ($resp) {
            $teatroEliminar->eliminar();
        }
    }

}