<?php


class FuncionTeatral extends Funcion
{

    public function calcCosto()
    {
        return parent::calcCosto() * 1.45;
    }
}