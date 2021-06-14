<?php


class Equipo
{
    private $nombre;
    private $nombreCapitan;
    private $cantJugadores;
    private $categoria;

    /**
     * Equipo constructor.
     * @param $nombre
     * @param $nombreCapitan
     * @param $cantJugadores
     * @param $categoria
     */
    public function __construct($nombre, $nombreCapitan, $cantJugadores, $categoria)
    {
        $this->nombre = $nombre;
        $this->nombreCapitan = $nombreCapitan;
        $this->cantJugadores = $cantJugadores;
        $this->categoria = $categoria;
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
    public function getNombreCapitan()
    {
        return $this->nombreCapitan;
    }

    /**
     * @param mixed $nombreCapitan
     */
    public function setNombreCapitan($nombreCapitan): void
    {
        $this->nombreCapitan = $nombreCapitan;
    }

    /**
     * @return mixed
     */
    public function getCantJugadores()
    {
        return $this->cantJugadores;
    }

    /**
     * @param mixed $cantJugadores
     */
    public function setCantJugadores($cantJugadores): void
    {
        $this->cantJugadores = $cantJugadores;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    public function obtenerInfoCategoria()
    {
        return $this->getCategoria()->__toString();
    }

    public function __toString()
    {
        $text = "Nombre Equipo: {$this->getNombre()}\nNombre capitán:{$this->getNombreCapitan()}\nCantidad de jugadores:{$this->getCantJugadores()}\n
        Categoria: {$this->obtenerInfoCategoria()}";

        return $text;
    }
}