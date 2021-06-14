<?php

require_once "Torneo.php";

class TorneoProvincial extends Torneo
{
    private $provincia;

    /**
     * TorneoProvincial constructor.
     * @param $idTorneo
     * @param $montoPremio
     * @param $localidad
     * @param $provincia
     */
    public function __construct($idTorneo, $montoPremio, $localidad, $provincia, $colPartidos)
    {
        parent::__construct($idTorneo, $montoPremio, $localidad, $colPartidos);
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia): void
    {
        $this->provincia = $provincia;
    }

    //TODO TOSTRING
}