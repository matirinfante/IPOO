<?php


class Partido
{
    private $idPartido;
    private $fecha;
    private $cantGolesE1;
    private $equipo1;
    private $cantGolesE2;
    private $equipo2;

    /**
     * Partido constructor.
     * @param $idPartido
     * @param $fecha
     * @param $cantGolesE1
     * @param $equipo1
     * @param $cantGolesE2
     * @param $equipo2
     */
    public function __construct($idPartido, $fecha, $cantGolesE1, $equipo1, $cantGolesE2, $equipo2)
    {
        $this->idPartido = $idPartido;
        $this->fecha = $fecha;
        $this->cantGolesE1 = $cantGolesE1;
        $this->equipo1 = $equipo1;
        $this->cantGolesE2 = $cantGolesE2;
        $this->equipo2 = $equipo2;
    }

    /**
     * @return mixed
     */
    public function getIdPartido()
    {
        return $this->idPartido;
    }

    /**
     * @param mixed $idPartido
     */
    public function setIdPartido($idPartido): void
    {
        $this->idPartido = $idPartido;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getCantGolesE1()
    {
        return $this->cantGolesE1;
    }

    /**
     * @param mixed $cantGolesE1
     */
    public function setCantGolesE1($cantGolesE1): void
    {
        $this->cantGolesE1 = $cantGolesE1;
    }

    /**
     * @return mixed
     */
    public function getEquipo1()
    {
        return $this->equipo1;
    }

    /**
     * @param mixed $equipo1
     */
    public function setEquipo1($equipo1): void
    {
        $this->equipo1 = $equipo1;
    }

    /**
     * @return mixed
     */
    public function getCantGolesE2()
    {
        return $this->cantGolesE2;
    }

    /**
     * @param mixed $cantGolesE2
     */
    public function setCantGolesE2($cantGolesE2): void
    {
        $this->cantGolesE2 = $cantGolesE2;
    }

    /**
     * @return mixed
     */
    public function getEquipo2()
    {
        return $this->equipo2;
    }

    /**
     * @param mixed $equipo2
     */
    public function setEquipo2($equipo2): void
    {
        $this->equipo2 = $equipo2;
    }

    public function obtenerInfoE1()
    {
        return $this->getEquipo1()->__toString();
    }

    public function obtenerInfoE2()
    {
        return $this->getEquipo2()->__toString();
    }

    public function __toString()
    {
        $text = "idPartido: {$this->getIdPartido()}\nFecha:{$this->getFecha()}\nEquipo 1:{$this->obtenerInfoE1()}\n
        Cantidad goles E1: {$this->getCantGolesE1()}\nEquipo 2: {$this->obtenerInfoE2()}\nCantidad goles E2: {$this->getCantGolesE2()}";

        return $text;
    }
}