<?php


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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getFuncion($index)
    {
        return $this->funciones[$index];
    }

    /**
     * @param mixed $funciones
     */
    public function setFuncion($index, $nombre, $precio)
    {
        $error = false;
        if ($index <= 4) {
            $this->funciones[$index] = array('nombre' => $nombre, 'precio' => $precio);
        } else {
            $error = "Index out of bounds";
        }

        return $error;
    }

    public function __toString()
    {
        $text = "Nombre teatro: {$this->nombre}\nDireccion: {$this->direccion}\nFunciones disponibles:\n";
        foreach ($this->funciones as $funcion){
            $text .= "**********\n";
            $text .= "Nombre: {$funcion['nombre']}\nPrecio: {$funcion['precio']}\n";
            $text .= "**********\n";
        }

        return $text;
    }
}