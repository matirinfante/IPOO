<?php


class Categoria
{
    private $idCategoria;
    private $descripcion;

    /**
     * Categoria constructor.
     * @param $idCategoria
     * @param $descripcion
     */
    public function __construct($idCategoria, $descripcion)
    {
        $this->idCategoria = $idCategoria;
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * @param mixed $idCategoria
     */
    public function setIdCategoria($idCategoria): void
    {
        $this->idCategoria = $idCategoria;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function __toString()
    {
        $text = "id Categoria: {$this->getIdCategoria()}\nDescripción:{$this->getDescripcion()}\n";

        return $text;
    }
}