<?php


class Funcion
{
    private $nombre;
    private $horaInicio;
    private $duracion;
    private $precio;

    /**
     * Funcion constructor.
     * @param $nombre
     * @param $horaInicio
     * @param $duracion
     * @param $precio
     */
    public function __construct($nombre, $horaInicio, $duracion, $precio)
    {
        $this->nombre = $nombre;
        $this->horaInicio = $horaInicio;
        $this->duracion = $duracion;
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * @param mixed $horaInicio
     */
    public function setHoraInicio($horaInicio): void
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion): void
    {
        $this->duracion = $duracion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    public function calcCosto()
    {
        return $this->getPrecio();
    }

    public function __toString(): string
    {
        $text = "Nombre: {$this->getNombre()}\nPrecio: {$this->getPrecio()}\nHorario: {$this->getHoraInicio()}\nDuración: {$this->getDuracion()}\n";

        return $text;
    }

}