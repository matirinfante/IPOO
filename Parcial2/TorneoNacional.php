<?php

require_once "Torneo.php";

class TorneoNacional extends Torneo
{

    /**
     * TorneoNacional constructor.
     * @param $idTorneo
     * @param $montoPremio
     * @param $localidad
     */
    public function __construct($idTorneo, $montoPremio, $localidad, $colPartidos)
    {
        parent::__construct($idTorneo, $montoPremio, $localidad, $colPartidos);
    }

    public function obtenerPremioTorneo()
    {
        $equipoGanador = $this->obtenerEquipoGanadorTorneo();
        $equipo = $equipoGanador['Equipo'];
        $cantGanados = 0;
        foreach ($this->getColPartidos() as $partido) {
            if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
                if ($equipo == $partido->getEquipo1()) {
                    $cantGanados++;
                } else {
                    if ($equipo == $partido->getEquipo2()) {
                        $cantGanados++;
                    }
                }
            }
        }

        return (parent::obtenerPremioTorneo() * 1.10) * $cantGanados;
    }
}