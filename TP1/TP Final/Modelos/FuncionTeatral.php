<?php


class FuncionTeatral extends Funcion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cargar($datos)
    {
        parent::cargar($datos);
    }

    public function calcCosto()
    {
        return parent::calcCosto() * 1.45;
    }

    public function buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM funcionteatral WHERE idfuncion={$idfuncion}";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    parent::buscar($idfuncion);
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
        $consultaFuncion = "SELECT * FROM funcion INNER JOIN funcionteatral c on funcion.idfuncion = c.idfuncion";
        if ($condicion != "") {
            $consultaFuncion = "{$consultaFuncion} WHERE {$condicion}";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arrCine = array();
                while ($row2 = $base->Registro()) {
                    $objCine = new FuncionTeatral();
                    $objCine->buscar($row2['idfuncion']);
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
            $consultaInsertar = "INSERT INTO funcionteatral VALUES(" . parent::getIdFuncion() . ")";
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
        parent::modificar();
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $qryDelete = "DELETE FROM funcionteatral WHERE idfuncion=" . parent::getIdfuncion();
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
        return parent::__toString();
    }
}