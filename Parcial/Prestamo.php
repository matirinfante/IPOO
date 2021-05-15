<?php

require "Cuota.php";
require "Persona.php";

class Prestamo
{
    private $identificacion;
    private $fechaOtorgamiento;
    private $monto;
    private $cantidadDeCuotas;
    private $tazaInteres;
    private $cuotas;
    private $cliente;

    /**
     * Prestamo constructor.
     * @param $identificacion
     * @param $fechaOtorgamiento
     * @param $monto
     * @param $cantidadDeCuotas
     * @param $tazaInteres
     * @param $cliente
     */
    public function __construct($identificacion, $fechaOtorgamiento, $monto, $cantidadDeCuotas, $tazaInteres, $cliente)
    {
        $this->identificacion = $identificacion;
        $this->fechaOtorgamiento = $fechaOtorgamiento;
        $this->monto = $monto;
        $this->cantidadDeCuotas = $cantidadDeCuotas;
        $this->tazaInteres = $tazaInteres;
        $this->cuotas = array();
        $this->cliente = $cliente;
    }


    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function setIdentificacion($identificacion): void
    {
        $this->identificacion = $identificacion;
    }


    public function getFechaOtorgamiento()
    {
        return $this->fechaOtorgamiento;
    }


    public function setFechaOtorgamiento($fechaOtorgamiento): void
    {
        $this->fechaOtorgamiento = $fechaOtorgamiento;
    }


    public function getMonto()
    {
        return $this->monto;
    }


    public function setMonto($monto): void
    {
        $this->monto = $monto;
    }


    public function getCantidadDeCuotas()
    {
        return $this->cantidadDeCuotas;
    }

    public function setCantidadDeCuotas($cantidadDeCuotas): void
    {
        $this->cantidadDeCuotas = $cantidadDeCuotas;
    }

    public function getTazaInteres()
    {
        return $this->tazaInteres;
    }

    public function setTazaInteres($tazaInteres): void
    {
        $this->tazaInteres = $tazaInteres;
    }

    public function getCuotas()
    {
        return $this->cuotas;
    }

    public function setCuotas($cuotas): void
    {
        $this->cuotas = $cuotas;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }

    public function obtenerCuotas()
    {
        $texto = "\n";
        foreach ($this->getCuotas() as $cuota) {
            $texto .= "{$cuota->__toString()}\n";
        }
        return $texto;
    }

    public function obtenerNombreCliente()
    {
        return "{$this->getCliente()->__toString()}";
    }

    public function __toString()
    {
        $texto = "Identificación: {$this->getIdentificacion()}\nFecha de Otorgamiento: {$this->getFechaOtorgamiento()}\nMonto Prestamo: {$this->getMonto()}\nCantidad de cuotas: {$this->getCantidadDeCuotas()}\nTaza de Interés: {$this->getTazaInteres()}\nCuotas: {$this->obtenerCuotas()}\nCliente: {$this->obtenerNombreCliente()}\n";
        return $texto;
    }

    public function calcularInteresPrestamo($numCuota)
    {
        return ($this->getMonto() - (($this->getMonto() / $this->getCantidadDeCuotas()) * $numCuota - 1)) * ($this->getTazaInteres() / 0.01);
    }

    public function otorgarPrestamo()
    {
        $cuotasTemp = array();
        $this->setFechaOtorgamiento(localtime());
        for ($i = 1; $i <= $this->getCantidadDeCuotas(); $i++) {
            $cuotasTemp[] = new Cuota($i, ($this->getMonto() / $this->getCantidadDeCuotas()), $this->calcularInteresPrestamo($i));
        }
        $this->setCuotas($cuotasTemp);
    }


    public function darSiguienteCuotaPagar()
    {
        $siguienteCuota = null;
        foreach ($this->getCuotas() as $cuota) {
            if (!$cuota->getCancelada()) {
                $siguienteCuota = $cuota;
                break;
            }
        }
        return $siguienteCuota;
    }
}