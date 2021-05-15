<?php

require "Prestamo.php";

class Financiera
{
    private $denominacion;
    private $direccion;
    private $prestamosOtorgados;

    /**
     * Financiera constructor.
     * @param $denominacion
     * @param $direccion
     */
    public function __construct($denominacion, $direccion)
    {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->prestamosOtorgados = array();
    }

    public function getDenominacion()
    {
        return $this->denominacion;
    }

    public function setDenominacion($denominacion): void
    {
        $this->denominacion = $denominacion;
    }


    public function getDireccion()
    {
        return $this->direccion;
    }


    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }


    public function getPrestamosOtorgados(): array
    {
        return $this->prestamosOtorgados;
    }

    public function setPrestamosOtorgados(array $prestamosOtorgados): void
    {
        $this->prestamosOtorgados = $prestamosOtorgados;
    }

    public function mostrarPrestamos()
    {
        $texto = "\n---- ----\n";

        foreach ($this->getPrestamosOtorgados() as $prestamo) {
            $texto .= "{$prestamo->__toString()}\n";
        }
        return $texto;
    }

    public function __toString()
    {
        $texto = "\n**** Info Financiera ****\n";
        $texto .= "Denominación: {$this->getDenominacion()}\nDirección: {$this->getDireccion()}\nPréstamos otorgados: {$this->mostrarPrestamos()}\n";
        return $texto;
    }

    public function incorporarPrestamo($nuevoPrestamo)
    {
        $this->prestamosOtorgados[] = $nuevoPrestamo;
    }

    public function otorgarPrestamoSiCalifica()
    {
        foreach ($this->getPrestamosOtorgados() as $prestamo) {
            if ($prestamo->getFechaOtorgamiento() == "") {
                if ($prestamo->getMonto() / $prestamo->getCantidadDeCuotas() < (($prestamo->getCliente()->getNeto() * 40) / 100)) {
                    $prestamo->otorgarPrestamo();
                }
            }
        }
    }

    public function informarCuotaPagar($idPrestamo)
    {
        $cuotaAPagar = null;
        foreach ($this->getPrestamosOtorgados() as $prestamo) {
            if ($prestamo->getIdentificacion() == $idPrestamo) {
                $cuotaAPagar = $prestamo->darSiguienteCuotaPagar();
                break;
            }
        }
        return $cuotaAPagar;
    }
}