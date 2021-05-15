<?php
/**
 * Autor: Matias Ricardo Infante Contreras
 * Legajo: FAI-1392
 * Facultad de Informática, Universidad Nacional del Comahue
 */

require_once "Financiera.php";
require_once "Prestamo.php";
require_once "Persona.php";

function main()
{
    $unaFinanciera = new Financiera("Money", "Av. Arg 1234");
    $prestamo1 = new Prestamo(1, "", 50000, 5, 0.1, new Persona("Pepe", "Florez",
        "18456798", "Bs As 12", "dir@gmail.com", "299 444567", 40000));
    $persona = new Persona("Luis", "Suarez",
        "18456795", "Bs As 123", "dir@gmail.com", "299 4445", 40000);
    $prestamo2 = new Prestamo(2, "", 10000, 4, 0.1, $persona);
    $prestamo3 = new Prestamo(3, "", 10000, 2, 0.1, $persona);

    $unaFinanciera->incorporarPrestamo($prestamo1);
    $unaFinanciera->incorporarPrestamo($prestamo2);
    $unaFinanciera->incorporarPrestamo($prestamo3);

    echo "Enunciado 4: \n" . $unaFinanciera;

    $unaFinanciera->otorgarPrestamoSiCalifica();
    echo "Enunciado 6: \n" . $unaFinanciera;

    $objCuota = $unaFinanciera->informarCuotaPagar(2);
    echo "Enunciado 8: \n" . $objCuota;
    if (!is_null($objCuota)) {
        $textoFormateado = is_null($objCuota) ? "Prestamo no otorgado. Cuota inaccesible." : $objCuota->darMontoFinalCuota();
        echo "Monto final cuota: {$textoFormateado}\n";


        $objCuota->setCancelada(true);

        $objCuota = $unaFinanciera->informarCuotaPagar(2);
        echo "Enunciado 12: \n" . $objCuota;
    } else {
        echo "Prestamo no otorgado. Cuota Inaccesible.";
    }
}


main();
