<?php


class Persona
{
    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;
    private $mail;
    private $telefono;
    private $neto;

    /**
     * Persona constructor.
     * @param $nombre
     * @param $apellido
     * @param $dni
     * @param $direccion
     * @param $mail
     * @param $telefono
     * @param $neto
     */
    public function __construct($nombre, $apellido, $dni, $direccion, $mail, $telefono, $neto)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->mail = $mail;
        $this->telefono = $telefono;
        $this->neto = $neto;
    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


    public function getApellido()
    {
        return $this->apellido;
    }


    public function setApellido($apellido): void
    {
        $this->apellido = $apellido;
    }


    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni): void
    {
        $this->dni = $dni;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }


    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }


    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }


    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getNeto()
    {
        return $this->neto;
    }


    public function setNeto($neto): void
    {
        $this->neto = $neto;
    }

    public function __toString()
    {
        $texto = "\n/// Cliente ///\n";
        $texto .= "Nombre: {$this->getNombre()}\nApellido: {$this->getApellido()}\nDNI: {$this->getDni()}\nDirección: {$this->getDireccion()}\nE-mail: {$this->getMail()}\nTelefono: {$this->getTelefono()}\nNeto: {$this->getNeto()}\n";
        return $texto;
    }

}