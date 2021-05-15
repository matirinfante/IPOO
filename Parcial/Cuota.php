<?php


class Cuota
{
    private $numero;
    private $montoCuota;
    private $montoInteres;
    private $cancelada;

    /**
     * Cuota constructor.
     * @param $numero
     * @param $montoCuota
     * @param $montoInteres
     */
    public function __construct($numero, $montoCuota, $montoInteres)
    {
        $this->numero = $numero;
        $this->montoCuota = $montoCuota;
        $this->montoInteres = $montoInteres;
        $this->cancelada = false;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    public function getMontoCuota()
    {
        return $this->montoCuota;
    }

    public function setMontoCuota($montoCuota): void
    {
        $this->montoCuota = $montoCuota;
    }

    public function getMontoInteres()
    {
        return $this->montoInteres;
    }

    public function setMontoInteres($montoInteres): void
    {
        $this->montoInteres = $montoInteres;
    }

    public function getCancelada()
    {
        return $this->cancelada;
    }

    public function setCancelada($cancelada): void
    {
        $this->cancelada = $cancelada;
    }

    public function __toString()
    {
        $texto = "--- Cuota ---\n";
        $textoCancelado = $this->getCancelada() ? "Si." : "No.";
        $texto = "Cuota Número: {$this->getNumero()}\nMonto: {$this->getMontoCuota()}\nMonto Interés: {$this->getMontoInteres()}\nCancelada: {$textoCancelado}\n";
        return $texto;
    }

    public function darMontoFinalCuota()
    {
        return $this->getMontoInteres() + $this->getMontoCuota();
    }
}