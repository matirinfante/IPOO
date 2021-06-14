<?php
require_once "TorneoProvincial.php";
require_once "TorneoNacional.php";

class MinisterioDeporte
{
    private $ano;
    private $colTorneos;

    /**
     * MinisterioDeporte constructor.
     * @param $ano
     * @param $colTorneos
     */
    public function __construct($ano)
    {
        $this->ano = $ano;
        $this->colTorneos = array();
    }

    /**
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * @param mixed $ano
     */
    public function setAno($ano): void
    {
        $this->ano = $ano;
    }

    /**
     * @return mixed
     */
    public function getColTorneos()
    {
        return $this->colTorneos;
    }

    /**
     * @param mixed $colTorneos
     */
    public function setColTorneos($colTorneos): void
    {
        $this->colTorneos = $colTorneos;
    }

    public function registrarTorneo($colPartidos, $tipo, $arrayAsoc)
    {
        $nuevoTorneo = null;
        switch ($tipo) {
            case "provincial":
                $nuevoTorneo = new TorneoProvincial($arrayAsoc['idTorneo'], $arrayAsoc['montoPremio'], $arrayAsoc['localidad'], $arrayAsoc['provincia'], $colPartidos);
                break;
            case "nacional":
                $nuevoTorneo = new TorneoNacional($arrayAsoc['idTorneo'], $arrayAsoc['montoPremio'], $arrayAsoc['localidad'], $colPartidos);
                break;
        }

        $array = $this->getColTorneos();
        array_push($array, $nuevoTorneo);
        return $nuevoTorneo;
    }

    public function otorgarPremioTorneo($idTorneo)
    {

        $exito = true;
        $i = 0;
        while ($exito) {
            $torneoSeleccionado = $this->getColTorneos()[$i];
            $auxIdTorneos = $torneoSeleccionado->getIdTorneo();
            if ($auxIdTorneos == $idTorneo)
                $exito = false;
        }

        $equipoGanador = $torneoSeleccionado->obtenerEquipoGanadorTorneo();
        $montoGanado = $torneoSeleccionado->obtenerPremioTorneo();

        return array("equipoGanador" => $equipoGanador, "montoGanado" => $montoGanado);
    }

    public function __toString(): string
    {
        $text = "Año: {$this->getAno()}
        \nTorneos: \n";
        $text .= $this->mostrarTorneos();
        return $text;
    }

    public function mostrarTorneos()
    {
        $i = 1;
        $text = "";
        foreach ($this->getColTorneos() as $torneo) {
            $text .= "-----------------------------------------------\n";
            $text .= "Torneo $i:";
            $text .= $torneo->__toString();
            $text .= "-----------------------------------------------\n";
            $i++;
        }
        return $text;
    }

}