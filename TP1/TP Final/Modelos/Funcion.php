<?php

include_once 'BaseDatos.php';

class Funcion
{
    private $idfuncion;
    private $nombre;
    private $horaInicio;
    private $duracion;
    private $precio;
    private $objTeatro;

    /**
     * Funcion constructor.
     * @param $nombre
     * @param $horaInicio
     * @param $duracion
     * @param $precio
     */
    public function __construct()
    {
        $this->idfuncion = 0;
        $this->nombre = "";
        $this->horaInicio = "";
        $this->duracion = 0;
        $this->precio = 0;
    }

    public function cargar($datos)
    {
        $this->setIdfuncion($datos['idfuncion']);
        $this->setNombre($datos['nombre']);
        $this->setHoraInicio($datos['hora_inicio']);
        $this->setDuracion($datos['duracion']);
        $this->setPrecio($datos['precio']);
        $this->setObjTeatro($datos['objteatro']);
    }

    public function cargarConObj($datos)
    {
        $this->setIdfuncion($datos['idfuncion']);
        $this->setNombre($datos['nombre']);
        $this->setHoraInicio($datos['hora_inicio']);
        $this->setDuracion($datos['duracion']);
        $this->setPrecio($datos['precio']);
        $this->setObjTeatro($datos['objteatro']);
    }

    /**
     * @return int
     */
    public function getIdfuncion()
    {
        return $this->idfuncion;
    }

    /**
     * @param int $idfuncion
     */
    public function setIdfuncion($idfuncion)
    {
        $this->idfuncion = $idfuncion;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * @param mixed $horaInicio
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @param mixed $duracion
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getObjTeatro()
    {
        return $this->objTeatro;
    }

    /**
     * @param mixed $objTeatro
     */
    public function setObjTeatro($objTeatro)
    {
        $this->objTeatro = $objTeatro;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function calcCosto()
    {
        return $this->getPrecio();
    }

    public function buscar($idfuncion)
    {
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM funcion WHERE idfuncion={$idfuncion}";
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                if ($row2 = $base->Registro()) {
                    $objTeatro = new Teatro();
                    $objTeatro->buscar($row2['idteatro']);
                    $row2['objteatro'] = $objTeatro;
                    $this->cargarConObj($row2);
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
        $arrFunciones = null;
        $base = new BaseDatos();
        $consultaFuncion = "SELECT * FROM funcion";
        if ($condicion != "") {
            $consultaFuncion = "{$consultaFuncion} WHERE {$condicion}";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaFuncion)) {
                $arrFunciones = array();
                while ($row2 = $base->Registro()) {
                    $idTeatro = $row2['idteatro'];
                    $funcion = new Funcion();
                    $funcion->buscar($row2['idfuncion']);
                    array_push($arrFunciones, $funcion);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrFunciones;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO funcion VALUES(null,'{$this->getNombre()}','{$this->getHoraInicio()}',{$this->getDuracion()},{$this->getPrecio()},{$this->getObjTeatro()->getIdTeatro()})";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdfuncion($id);
                //$teatroVinculado = new Teatro();
                //$teatroVinculado->buscar($this->getObjTeatro());
                //$this->setObjTeatro($teatroVinculado);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;


    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE funcion SET nombre='{$this->getNombre()}',hora_inicio='{$this->getHoraInicio()}',duracion={$this->getDuracion()},precio={$this->getPrecio()} 
        WHERE idfuncion = {$this->getIdfuncion()}";
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
            $qryDelete = "DELETE FROM funcion WHERE idfuncion= {$this->getIdfuncion()}";
            if ($base->Ejecutar($qryDelete)) {
                $resp = true;
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
        $text = "ID Funcion:{$this->idfuncion}\nNombre: {$this->getNombre()}\nPrecio: {$this->getPrecio()}\nHorario: {$this->getHoraInicio()}\nDuración: {$this->getDuracion()}\n";

        return $text;
    }

}