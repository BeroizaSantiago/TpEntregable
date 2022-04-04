<?php
include 'Viaje.php';
echo "Ingrese el nro del codigo del viaje:";
$codigo = trim(fgets(STDIN));
echo "Ingrese el destino del viaje:";
$destino = trim(fgets(STDIN));
echo "Ingrese la capacidad maxima de pasajeros del viaje:";
$capacidadMaxima = trim(fgets(STDIN));

$objViajeNuevo = new Viaje($codigo, $destino,$capacidadMaxima);
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
            echo "El pasajero: ".$pasajero['nombre']." ".$pasajero['apellido']." fue agregado con exito";
            
        }else{
            echo "El pasajero ya se encuentra en el viaje";
        }
        break;
    case '5':
        
        echo "Ingrese el pasajero que quiere modificar: \n";
        $pasajero = datosPasajeros();
        
        echo "Ingrese los datos del nuevo pasajero:\n ";
        $nuevoPasajero = datosPasajeros();
        
        if($objViajeNuevo->modificarPasajero($pasajero, $nuevoPasajero)){
            echo "Se ha modificado al pasajero";
        }else{
            echo "Pasajero no encontrado ";
        }
        break;
    case '6':
        echo $objViajeNuevo;
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
7.Salir.
-------------------------------------------- " ;
}


function datosPasajeros(){
    echo "Ingrese el nombre del pasajero: ";
    $nombrePasajero = trim(fgets(STDIN));
    echo "Ingrese el apellido del pasajero: ";
    $apellidoPasajero = trim(fgets(STDIN));
    echo "Ingrese el DNI del pasajero: ";
    $dniPasajero = trim(fgets(STDIN));
    $datosPasajero = ['nombre'=>$nombrePasajero, 'apellido'=>$apellidoPasajero,'dni'=>$dniPasajero];
        
    return $datosPasajero;
}
