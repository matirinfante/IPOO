<?php

require "Funcion.php";

class Cine extends Funcion
{
    private $genero;
    private $paisOrigen;

    public function __construct($nombre, $horaInicio, $duracion, $precio, $genero, $paisOrigen)
    {
        parent::__construct($nombre, $horaInicio, $duracion, $precio);
        $this->genero = $genero;
        $this->paisOrigen = $paisOrigen;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero): void
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * @param mixed $paisOrigen
     */
    public function setPaisOrigen($paisOrigen): void
    {
        $this->paisOrigen = $paisOrigen;
    }

    public function calcCosto()
    {
        return parent::calcCosto() * 1.65;
    }

    public function __toString(): string
    {
        $text = parent::__toString();
        $text .= "Genero:{$this->getGenero()}\nPais:{$this->getPaisOrigen()}\n";
        return $text;

    }
}