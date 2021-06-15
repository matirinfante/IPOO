<?php

include_once 'ABM_Teatro.php';
include_once 'ABM_Cine.php';


main();

function main()
{
    $obj = new Teatro();
    ABM_Teatro::altaTeatro("Cinemark", "Dr ramon 123");
    ABM_Cine::altaCine(null, "Godzilla", "12:30", 120, 200, 74, "Acción", "USA");
    $obj->buscar(74);
    echo $obj->__toString();
    print ("ELIMINACION");
    ABM_Teatro::eliminarTeatro(74);
}