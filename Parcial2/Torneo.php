<?php

require_once "Partido.php";

class Torneo
{
    private $idTorneo;
    private $colPartidos;
    private $montoPremio;
    private $localidad;

    /**
     * Torneo constructor.
     * @param $idTorneo
     * @param $colPartidos
     * @param $montoPremio
     * @param $localidad
     */
    public function __construct($idTorneo, $montoPremio, $localidad, $colPartidos)
    {
        $this->idTorneo = $idTorneo;
        $this->colPartidos = $colPartidos;
        $this->montoPremio = $montoPremio;
        $this->localidad = $localidad;
    }

    /**
     * @return mixed
     */
    public function getIdTorneo()
    {
        return $this->idTorneo;
    }

    /**
     * @param mixed $idTorneo
     */
    public function setIdTorneo($idTorneo): void
    {
        $this->idTorneo = $idTorneo;
    }

    /**
     * @return array
     */
    public function getColPartidos(): array
    {
        return $this->colPartidos;
    }

    /**
     * @param array $colPartidos
     */
    public function setColPartidos(array $colPartidos): void
    {
        $this->colPartidos = $colPartidos;
    }

    /**
     * @return mixed
     */
    public function getMontoPremio()
    {
        return $this->montoPremio;
    }

    /**
     * @param mixed $montoPremio
     */
    public function setMontoPremio($montoPremio): void
    {
        $this->montoPremio = $montoPremio;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param mixed $localidad
     */
    public function setLocalidad($localidad): void
    {
        $this->localidad = $localidad;
    }

    public function obtenerEquipoGanadorTorneo()
    {
        $arrInfoTorneo = array();
        foreach ($this->getColPartidos() as $partido) {
            $equipo1 = $partido->getEquipo1()->getNombre();
            $equipo2 = $partido->getEquipo2()->getNombre();
            if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
                //Si gana E1
                if (array_key_exists($equipo1, $arrInfoTorneo)) {
                    $arrInfoTorneo[$equipo1]['partidosGanados']++;
                    $arrInfoTorneo[$equipo1]['goles'] += $partido->getCantGolesE1();
                    if (array_key_exists($equipo2, $arrInfoTorneo)) {
                        //Existe E2
                        $arrInfoTorneo[$equipo2]['goles'] += $partido->getCantGolesE2();
                    } else {
                        //Añadiendo entrada
                        $arrInfoTorneo[$equipo2] = array("Equipo" => $partido->getEquipo2(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE2());
                    }
                } else {
                    //Añadiendo entrada
                    $arrInfoTorneo[$equipo1] = array("Equipo" => $partido->getEquipo1(), "partidosGanados" => 1, "goles" => $partido->getCantGolesE1());
                    if (array_key_exists($equipo2, $arrInfoTorneo)) {
                        //Existe E2
                        $arrInfoTorneo[$equipo2]['goles'] += $partido->getCantGolesE2();
                    } else {
                        //Añadiendo entrada
                        $arrInfoTorneo[$equipo2] = array("Equipo" => $partido->getEquipo2(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE2());
                    }
                }
            } else if ($partido->getCantGolesE2() > $partido->getCantGolesE1()) {
                //Si gana E2
                if (array_key_exists($equipo2, $arrInfoTorneo)) {
                    $arrInfoTorneo[$equipo2]['partidosGanados']++;
                    $arrInfoTorneo[$equipo2]['goles'] += $partido->getCantGolesE2();
                    if (array_key_exists($equipo1, $arrInfoTorneo)) {
                        $arrInfoTorneo[$equipo1]['goles'] += $partido->getCantGolesE1();
                    } else {
                        $arrInfoTorneo[$equipo1] = array("Equipo" => $partido->getEquipo1(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE1());
                    }
                } else {
                    //Añadiendo entrada
                    $arrInfoTorneo[$equipo2] = array("Equipo" => $partido->getEquipo2(), "partidosGanados" => 1, "goles" => $partido->getCantGolesE2());
                    if (array_key_exists($equipo1, $arrInfoTorneo)) {
                        $arrInfoTorneo[$equipo1]['goles'] += $partido->getCantGolesE1();
                    } else {
                        $arrInfoTorneo[$equipo1] = array("Equipo" => $partido->getEquipo1(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE1());
                    }
                }
            } else {
                if (array_key_exists($equipo1, $arrInfoTorneo)) {
                    $arrInfoTorneo[$equipo1]['goles'] += $partido->getCantGolesE1();
                } else {
                    $arrInfoTorneo[$equipo1] = array("Equipo" => $partido->getEquipo1(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE1());
                }

                if (array_key_exists($equipo2, $arrInfoTorneo)) {
                    $arrInfoTorneo[$equipo2]['goles'] += $partido->getCantGolesE2();
                } else {
                    $arrInfoTorneo[$equipo2] = array("Equipo" => $partido->getEquipo2(), "partidosGanados" => 0, "goles" => $partido->getCantGolesE2());
                }
            }
        }

        usort($arrInfoTorneo, function ($equipo1, $equipo2) {
            return $equipo1['partidosGanados'] <=> $equipo2['partidosGanados'];
        });

        if (!empty($arrInfoTorneo)) {
            $primerEquipo = $arrInfoTorneo[array_key_first($arrInfoTorneo)];
            $equipoGanador = array("Equipo" => $primerEquipo['Equipo'], "goles" => ['goles']);
        }

        return $equipoGanador;
    }

    public function obtenerPremioTorneo()
    {
        return $this->getMontoPremio();
    }

    public function __toString(): string
    {
        $text = "Id Torneo: {$this->getIdTorneo()}
        \nMonto Premio: {$this->getMontoPremio()}
        \nLocalidad: {$this->getLocalidad()}
        \nPartidos:\n";
        $text .= $this->listarPartidos();
        return $text;
    }

    public function listarPartidos()
    {
        $i = 1;
        $text = "";
        foreach ($this->getColPartidos() as $partido) {
            $text .= "\n-----------------------------------------------\n";
            $text .= "Partido $i:";
            $text .= $partido->__toString();
            $text .= "\n-----------------------------------------------\n";
            $i++;
        }
        return $text;
    }
}