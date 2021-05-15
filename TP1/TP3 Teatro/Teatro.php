<?php

include "Cine.php";
include "FuncionTeatral.php";
include "Musical.php";

class Teatro
{
    private $nombre;
    private $direccion;
    private $funciones;

    /**
     * Teatro constructor.
     * @param $nombre
     * @param $direccion
     * @param $funciones
     */
    public function __construct($nombre, $direccion)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->funciones = array();
    }

    /**
     * @return $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return $direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return $funcion array
     */
    public function obtenerFuncion($index)
    {
        return $this->funciones[$index];
    }

    public function getFunciones()
    {
        return $this->funciones;
    }

    public function setFunciones($arr)
    {
        $this->funciones = $arr;
    }

    /**
     * @param $index
     * @param $nombre
     * @param $precio
     * @return bool
     */
    public function modificarFuncion($nombreFuncion, $nombreNuevo, $precio)
    {
        $tempFuncion = $this->buscarFuncion($nombreFuncion);

        if (!is_null($tempFuncion)) {
            $tempFuncion->setNombre($nombreNuevo);
            $tempFuncion->setPrecio($precio);
        }

        return is_null($tempFuncion);
    }

    /**
     * Metodo que se encargar de insertar una función
     * @param $nombre
     * @param $precio
     * @param $horaInicio
     * @param $duracion
     * @return bool
     */
    public function insertarFuncion($funcion)
    {
        $exito = false;
        if (($this->verificarHorario($funcion->getHoraInicio(), $funcion->getDuracion()))) {
            $tempFunciones = $this->getFunciones();
            $tempFunciones[] = $funcion;
            $this->setFunciones($tempFunciones);
            $exito = true;
        }
        return $exito;
    }

    /**
     * @return string
     */
    public function mostrarFunciones()
    {
        $text = "";
        foreach ($this->funciones as $funcion) {
            $text .= "**********\n";
            $text .= $funcion->__toString();
            $text .= "**********\n";
        }
        return $text;
    }

    /**
     * @param $nombreFuncion
     * @return bool
     */
    public function buscarCoincidencias($nombreFuncion)
    {
        $existe = false;
        foreach ($this->funciones as $funcion) {

            if (strtolower($funcion->getNombre()) == $nombreFuncion) {
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    /**
     * @param $nombreFuncion
     * @return object
     */
    public function buscarFuncion($nombreFuncion)
    {
        $funcionEncontrada = null;
        foreach ($this->funciones as $funcion) {
            if (strtolower($funcion->getNombre()) == $nombreFuncion) {
                $funcionEncontrada = $funcion;
                break;
            }
        }
        return $funcionEncontrada;
    }

    /**
     * @param $horaInicio
     * @param $duracion
     * @return bool
     */
    private function verificarHorario($horaInicio, $duracion)
    {
        $exito = true;
        $horaEnMinutos = $this->aMinutos($horaInicio);
        $horaFinalizacionEnMinutos = $horaEnMinutos + (int)$duracion;

        foreach ($this->funciones as $funcion) {
            $horaAComparar = $this->aMinutos($funcion->getHoraInicio());
            $horaFinalAComparar = $horaAComparar + $funcion->getDuracion();


            if (($horaAComparar >= $horaEnMinutos && $horaAComparar <= $horaFinalizacionEnMinutos) || ($horaFinalAComparar >= $horaEnMinutos && $horaFinalAComparar <= $horaFinalizacionEnMinutos)) {
                $exito = false;
                break;
            }
        }

        return $exito;
    }

    /**
     * @param $horario
     * @return int
     */
    private function aMinutos($horario)
    {
        $horas = (int)substr($horario, 0, 2);
        $minutos = (int)substr($horario, 3, 2);
        $horaEnMin = $horas * 60 + $minutos;
        return $horaEnMin;

    }

    public function darCosto()
    {
        $sumatoria = 0;
        foreach ($this->getFunciones() as $funcion) {
            $sumatoria += $funcion->calcCosto();
        }
        return $sumatoria;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $text = "Nombre teatro: {$this->getNombre()}\nDireccion: {$this->getDireccion()}\nFunciones disponibles:\n";
        $text .= $this->mostrarFunciones();

        return $text;
    }
}