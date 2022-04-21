<?php
include 'Viaje.php';
include 'Pasajero.php';
include 'ResponsableV.php';


echo "Ingrese el nro del codigo del viaje:";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino del viaje:";
$destino = trim(fgets(STDIN));
echo "Ingrese la capacidad maxima de pasajeros del viaje:";
$capacidadMaxima = trim(fgets(STDIN));

echo "Ingrese los datos del responsable: ";
echo "\nNombre: ";
$nombre = trim(fgets(STDIN));
echo "Apellido: ";
$apellido = trim(fgets(STDIN));
echo "Numero de Empleado: ";
$numEmpleado = trim(fgets(STDIN));
echo "Numero de Licencia: ";
$numLicencia = trim(fgets(STDIN));

$objResponsable = new ResponsableV($nombre, $apellido, $numEmpleado, $numLicencia);
$objViajeNuevo = new Viaje($codigo, $destino,$capacidadMaxima, $objResponsable);

$corte = true;
do{
echo menu();
$opcion = trim(fgets(STDIN));

switch($opcion){
    case '1':
        echo "El codigo es: ".$codigo. "\n";
        echo "Ingrese el nuevo codigo: \n";
        $codigoNuevo = trim(fgets(STDIN));
        $objViajeNuevo->setCodViaje($codigoNuevo);
        echo "el nuevo codigo es: ".$objViajeNuevo->getCodViaje();
        break;
    case '2':
        echo "El destino es: ".$destino. "\n";
        echo "Ingrese el nuevo destino \n";
        $destinoNuevo = trim(fgets(STDIN));
        $objViajeNuevo->setDest($destinoNuevo);
        echo "el nuevo destino es: ".$objViajeNuevo->getDest();
        break;
    case '3':
        echo "La cantidad de pasajeros es de: ".$objViajeNuevo->getCantMaxPasajeros()."\n";
        echo "Ingrese la nueva cantidad de pasajeros: \n";
        $nuevaCantidad = trim(fgets(STDIN));
        $objViajeNuevo->setcatMaxPasajeros($nuevaCantidad);
        echo "La nueva cantidad maxima es de: ". $objViajeNuevo->getCantMaxPasajeros();
        break;
    case '4':
        $pasajero = datosPasajeros();
        if($objViajeNuevo->agregarPasajero($pasajero)){
            echo "El pasajero fue agregado con exito";
            
        }else{
            echo "El pasajero ya se encuentra en el viaje";
        }
        break;
    case '5':
        
        echo "Ingrese el Dni del pasajero a modificar:\n ";
        $dniPasajero = trim(fgets(STDIN));

        if($objViajeNuevo->modificarPasajero($dniPasajero)){
            echo "Se ha modificado al pasajero";
        }else{
            echo "Pasajero no encontrado ";
        }
        break;
    case '6':
        echo $objViajeNuevo;
        break;
    case '7':
        $responsable = $objViajeNuevo->getResponsableViaje();
        echo $responsable;
        break;
    case '8':
        echo "Ingrese los nuevos datos del responsable: \n";
        echo "Nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Numero de Empleado: ";
        $numEmpleado = trim(fgets(STDIN));
        echo "Numero de Licencia: ";
        $numLicencia = trim(fgets(STDIN));
        $objResponsable = new ResponsableV($nombre, $apellido, $numEmpleado, $numLicencia);
        $objViajeNuevo->setResponsableViaje($objResponsable);
        break;


    default:
    $corte = false;
    break;
}

}while ($corte);


function menu(){
echo "
-------------------------------------------- 
Selecciones una opcion del Menu. 
1.Modificar el Codigo del viaje.
2.Modificar el Destino del viaje.
3.Modificar la Cantidad Maxima de pasajeros.
4.Agregar Pasajero.
5.Modificar Pasajero.
6.Mostrar viaje.
7.Ver datos del Responsable del Viaje.
8.Modificar datos del Responsable.
9.Salir.
-------------------------------------------- " ;
}


function datosPasajeros(){
    echo "Ingrese el nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido del pasajero: ";
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el DNI del pasajero: ";
    $dniPasajero = trim(fgets(STDIN));
    echo "Ingrese el telefono del pasajero: ";
    $telefonoPasajero = trim(fgets(STDIN));
    $objPasajero = new Pasajero($nombrePasajero,$apellidoPasajero,$dniPasajero,$telefonoPasajero);
        
    return $objPasajero;
}
