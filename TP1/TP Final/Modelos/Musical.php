<?php


class Musical extends Funcion
{
    private $director;
    private $cantPersonas;

    public function __construct()
    {
        parent::__construct();
        $this->director = "";
        $this->cantPersonas = 0;
    }

    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setDirector($datos['director']);
        $this->setCantPersonas($datos['cantidad_personas']);
    }

    /**
     * @return mixed
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param mixed $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return mixed
     */
    public function getCantPersonas()
    {
        return $this->cantPersonas;
    }

    /**
     * @param mixed $cantPersonas
     */
    public function setCantPersonas($cantPersonas)
    {
        $this->cantPersonas = $cantPersonas;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function calcCosto()
    {
        return parent::calcCosto() * 1.12;
    }

    public function buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM musical WHERE idfuncion={$idfuncion}";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    parent::buscar($idfuncion);
                    $this->setDirector($row2['director']);
                    $this->setCantPersonas($row2['cantidad_personas']);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = "")
    {
        $arrMusical = null;
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM musical m, funcion f";
        if ($condicion != "") {
            $consultaFuncion = "{$consultaFuncion} WHERE {$condicion}";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arrMusical = array();
                while ($row2 = $base->Registro()) {
                    $objMusical = new Musical();
                    $objMusical->cargar($row2);
                    array_push($arrMusical, $objMusical);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrMusical;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO musical VALUES(" . parent::getIdFuncion() . ",'{$this->getDirector()}','{$this->getCantPersonas()}')";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE musical SET director='{$this->getDirector()}', cantidad_personas='{$this->getCantPersonas()}' 
        WHERE idfuncion =" . parent::getIdfuncion();
        if (parent::modificar()) {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $qryDelete = "DELETE FROM musical WHERE idfuncion=" . parent::getIdfuncion();
            if ($base->Ejecutar($qryDelete)) {
                $resp = true;
                parent::eliminar();
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function __toString()
    {
        $text = parent::__toString();
        $text .= "Director:{$this->getDirector()}\nPersonas en Escena:{$this->getCantPersonas()}\n";
        return $text;
    }

}