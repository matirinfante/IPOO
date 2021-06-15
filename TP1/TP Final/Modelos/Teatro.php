<?php

require_once 'BaseDatos.php';
include "Cine.php";
include "FuncionTeatral.php";
include "Musical.php";

class Teatro
{
    private $idteatro;
    private $nombre;
    private $direccion;
    private $funciones;

    /**
     * Teatro constructor.
     * @param $nombre
     * @param $direccion
     * @param $funciones
     */
    public function __construct()
    {
        $this->idteatro = 0;
        $this->nombre = "";
        $this->direccion = "";
        $this->funciones = array();
    }

    public function cargar($idteatro, $nombre, $direccion)
    {
        $this->setIdteatro($idteatro);
        $this->setNombre($nombre);
        $this->setDireccion($direccion);

        $this->actualizarFunciones();
    }

    /**
     * @return int
     */
    public function getIdteatro()
    {
        return $this->idteatro;
    }

    /**
     * @param int $idteatro
     */
    public function setIdteatro($idteatro)
    {
        $this->idteatro = $idteatro;
    }

    /**
     * @return $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return $direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return $funcion array
     */
    public function obtenerFuncion($index)
    {
        return $this->funciones[$index];
    }

    public function getFunciones()
    {
        $this->actualizarFunciones();
        return $this->funciones;
    }

    private function actualizarFunciones()
    {
        $objCine = new Cine();
        $objMusical = new Musical();
        $objTeatral = new FuncionTeatral();

        $funcionCine = $objCine->listar("c.idfuncion=f.idfuncion AND f.idteatro={$this->getIdteatro()}");
        $funcionMusical = $objMusical->listar("m.idfuncion=f.idfuncion AND f.idteatro={$this->getIdteatro()}");
        $funcionTeatral = $objTeatral->listar("f.idteatro={$this->getIdteatro()}");

        $this->setFunciones(array_merge($funcionCine, $funcionMusical, $funcionTeatral));
    }

    public function setFunciones($arr)
    {
        $this->funciones = $arr;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * @param $index
     * @param $nombre
     * @param $precio
     * @return bool
     */
    public function modificarFuncion($idfuncion, $nombreNuevo, $precio)
    {
        $tempFuncion = $this->buscarFuncion($idfuncion);

        if (!is_null($tempFuncion)) {
            $tempFuncion->setNombre($nombreNuevo);
            $tempFuncion->setPrecio($precio);
        }

        return is_null($tempFuncion);
    }

    /**
     * Metodo que se encargar de insertar una función
     * @param $nombre
     * @param $precio
     * @param $horaInicio
     * @param $duracion
     * @return bool
     */
    public function insertarFuncion($funcion)
    {
        $exito = false;
        if (($this->verificarHorario($funcion->getHoraInicio(), $funcion->getDuracion()))) {
            $tempFunciones = $this->getFunciones();
            $tempFunciones[] = $funcion;
            $this->setFunciones($tempFunciones);
            $exito = true;
        }
        return $exito;
    }

    /**
     * @return string
     */
    public function mostrarFunciones()
    {
        $text = "";
        foreach ($this->getFunciones() as $funcion) {
            $text .= "**********\n";
            $text .= $funcion->__toString();
            $text .= "**********\n";
        }
        return $text;
    }

    /**
     * @param $nombreFuncion
     * @return bool
     */
    public function buscarCoincidencias($idfuncion)
    {
        $existe = false;
        foreach ($this->getFunciones() as $funcion) {

            if (strtolower($funcion->getIdFuncion()) == $idfuncion) {
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    /**
     * @param $nombreFuncion
     * @return object
     */
    public function buscarFuncion($idfuncion)
    {
        $funcionEncontrada = null;
        foreach ($this->getFunciones() as $funcion) {
            if (strtolower($funcion->getIdFuncion()) == $idfuncion) {
                $funcionEncontrada = $funcion;
                break;
            }
        }
        return $funcionEncontrada;
    }

    /**
     * @param $horaInicio
     * @param $duracion
     * @return bool
     */
    private function verificarHorario($horaInicio, $duracion)
    {
        $exito = true;
        $horaEnMinutos = $this->aMinutos($horaInicio);
        $horaFinalizacionEnMinutos = $horaEnMinutos + (int)$duracion;

        foreach ($this->getFunciones() as $funcion) {
            $horaAComparar = $this->aMinutos($funcion->getHoraInicio());
            $horaFinalAComparar = $horaAComparar + $funcion->getDuracion();


            if (($horaAComparar >= $horaEnMinutos && $horaAComparar <= $horaFinalizacionEnMinutos) || ($horaFinalAComparar >= $horaEnMinutos && $horaFinalAComparar <= $horaFinalizacionEnMinutos)) {
                $exito = false;
                break;
            }
        }
        return $exito;
    }

    /**
     * @param $horario
     * @return int
     */
    private function aMinutos($horario)
    {
        $horas = (int)substr($horario, 0, 2);
        $minutos = (int)substr($horario, 3, 2);
        $horaEnMin = $horas * 60 + $minutos;
        return $horaEnMin;

    }

    public function darCosto()
    {
        $sumatoria = 0;
        foreach ($this->getFunciones() as $funcion) {
            $sumatoria += $funcion->calcCosto();
        }
        return $sumatoria;
    }

    public function buscar($idteatro)
    {
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro WHERE idteatro={$idteatro}";
        $resp = false;
        if ($base->Iniciar()) {

            if ($base->Ejecutar($consultaTeatro)) {

                if ($row2 = $base->Registro()) {

                    $this->cargar($idteatro, $row2['nombre'], $row2['direccion']);

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
        $arrTeatros = null;
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro";
        if ($condicion != "") {
            $consultaTeatro = "{$consultaTeatro} WHERE {$condicion}";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arrTeatros = array();
                while ($row2 = $base->Registro()) {
                    $idTeatro = $row2['idteatro'];
                    $nombre = $row2['nombre'];
                    $direccion = $row2['direccion'];

                    $teatro = new Teatro();
                    $teatro->cargar($idTeatro, $nombre, $direccion);
                    array_push($arrTeatros, $teatro);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arrTeatros;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO teatro VALUES(null,'{$this->getNombre()}','{$this->getDireccion()}')";

        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdteatro($id);
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
        $consultaModifica = "UPDATE teatro SET nombre='{$this->getNombre()}',direccion='{$this->getDireccion()}' WHERE idteatro = {$this->getIdteatro()}";
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
            $arrTeatros = $this->getFunciones();

            if (count($arrTeatros) != 0) {

                foreach ($arrTeatros as $funcion) {
                    $funcion->eliminar();
                }
            }
            $qryDelete = "DELETE FROM teatro WHERE idTeatro= {$this->getIdTeatro()}";
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


    /**
     * @return string
     */
    public function __toString()
    {
        $text = "ID:{$this->getIdteatro()}\nNombre teatro: {$this->getNombre()}\nDireccion: {$this->getDireccion()}\nFunciones disponibles:\n";
        $text .= $this->mostrarFunciones();

        return $text;
    }
}