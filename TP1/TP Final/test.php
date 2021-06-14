<?php

include_once 'ABM_Teatro.php';
include_once 'ABM_Cine.php';


main();

function main()
{
    $obj = new Teatro();
    ABM_Teatro::altaTeatro("Cinemark", "Dr ramon 123");
    ABM_Cine::altaCine(null, "Godzilla", "12:30", 120, 200, 31, "Acción", "USA");
    //$obj->cargar(null, "CINEMARK", "DR RAMON 123");
    //$obj->insertar();
    $obj->buscar(31);
    echo $obj->__toString();

}