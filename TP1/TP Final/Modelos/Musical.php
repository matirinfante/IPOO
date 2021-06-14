<?php


class Musical extends Funcion
{
    private $director;
    private $cantPersonas;

    public function __construct($nombre, $horaInicio, $duracion, $precio, $director, $cantPersonas)
    {
        parent::__construct($nombre, $horaInicio, $duracion, $precio);
        $this->director = $director;
        $this->cantPersonas = $cantPersonas;
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getCantPersonas()
    {
        return $this->cantPersonas;
    }

    /**
     * @param mixed $cantPersonas
     */
    public function setCantPersonas($cantPersonas)
    {
        $this->cantPersonas = $cantPersonas;
    }

    public function calcCosto()
    {
        return parent::calcCosto() * 1.12;
    }

    public function __toString()
    {
        $text = parent::__toString();
        $text .= "Director:{$this->getDirector()}\nPersonas en Escena:{$this->getCantPersonas()}\n";
        return $text;
    }

}