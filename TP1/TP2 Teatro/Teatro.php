<?php

include "Funcion.php";

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
    public function __construct($nombre = "", $direccion = "")
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
    public function getFuncion($index)
    {
        return $this->funciones[$index];
    }


    /**
     * @param $index
     * @param $nombre
     * @param $precio
     * @return bool
     */
    public function setFuncion($nombreFuncion, $nombreNuevo, $precio)
    {
        $tempFuncion = $this->buscarFuncion($nombreFuncion);

        if (!is_null($tempFuncion)) {
            $tempFuncion->setNombre($nombreNuevo);
            $tempFuncion->setPrecio($precio);
        }

        return is_null($tempFuncion);
    }

    /**
     * @param $nombre
     * @param $precio
     * @param $horaInicio
     * @param $duracion
     * @return bool
     */
    public function insertarFuncion($nombre, $precio, $horaInicio, $duracion)
    {
        $exito = false;
        if (($this->verificarHorario($horaInicio, $duracion))) {

            $nuevaFuncion = new Funcion($nombre, $horaInicio, $duracion, $precio);

            $this->funciones[] = $nuevaFuncion;
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
            $text .= "Nombre: {$funcion->getNombre()}\nPrecio: {$funcion->getPrecio()}\nHorario: {$funcion->getHoraInicio()}\n";
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