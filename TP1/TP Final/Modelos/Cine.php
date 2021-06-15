<?php

require "Funcion.php";

class Cine extends Funcion
{
    private $genero;
    private $paisOrigen;

    public function __construct()
    {
        parent::__construct();
        $this->genero = "";
        $this->paisOrigen = "";
    }

    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setGenero($datos['genero']);
        $this->setPaisOrigen($datos['pais_origen']);
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * @param mixed $paisOrigen
     */
    public function setPaisOrigen($paisOrigen)
    {
        $this->paisOrigen = $paisOrigen;
    }

    public function calcCosto()
    {
        return parent::calcCosto() * 1.65;
    }

    public function buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM cine WHERE idfuncion={$idfuncion}";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    parent::buscar($idfuncion);
                    $this->setGenero($row2['genero']);
                    $this->setPaisOrigen($row2['pais_origen']);
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
        $arrCine = null;
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM cine c, funcion f";
        if ($condicion != "") {
            $consultaFuncion = "{$consultaFuncion} WHERE {$condicion}";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arrCine = array();
                while ($row2 = $base->Registro()) {
                    $objCine = new Cine();
                    $objCine->cargar($row2);
                    array_push($arrCine, $objCine);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrCine;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO cine VALUES(" . parent::getIdFuncion() . ",'{$this->getGenero()}','{$this->getPaisOrigen()}')";
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
        $consultaModifica = "UPDATE cine SET genero={$this->getGenero()}, pais_origen={$this->getPaisOrigen()} 
        WHERE idfuncion =" . parent::getIdfuncion();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            print ("pasa borrar cine\n");
            $qryDelete = "DELETE FROM cine WHERE idfuncion=" . parent::getIdfuncion();
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
        $text .= "Genero:{$this->getGenero()}\nPais:{$this->getPaisOrigen()}\n";
        return $text;

    }
}