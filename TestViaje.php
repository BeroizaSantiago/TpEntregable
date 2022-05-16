<?php
include 'Empresa.php';
include 'ResponsableV.php';
include 'Viaje.php';
include 'Pasajero.php';
include 'Terrestre.php';
include 'Aereo.php';

//Creacion de responsables
$responsable1 = new ResponsableV( 'Julio', 'Pez',14, 57);
$responsable2 = new ResponsableV('Alfredo', 'Brizuela',17, 35);
$responsable3 = new ResponsableV('Maria', 'Del Barrio',15, 66) ;
//Creacion de pasajeros
$pasajero1 = new Pasajero('Carlos', 'Zantana', 12345678, 45678);
$pasajero2 = new Pasajero('Lucas', 'Pato', 45678945, 102345);
$pasajero3 = new Pasajero('Esteban', 'Mendoza', 4567852, 1234587);
$pasajero4 = new Pasajero('Romina', 'Estevez', 4679852, 4268753);
//Creacion empresa
$empresa1 = new Empresa('Lost');
//Creacion viajes
$viaje1 = new Terrestre(1, 'Bariloche', 32, $responsable1, 'Cama', 1500, 'Ida y Vuelta');
$viaje2 = new Aereo(2, 'Brasil', 45, $responsable2, 2500, 'Ida y Vuelta', 566, 'Primera Clase', 'Flotaremos', 0);
$viaje3 = new Terrestre(3, 'El Chocon', 40, $responsable3, 'Cama', 1800, 'Ida y Vuelta');
//
$array1 = [$pasajero1, $pasajero2, $pasajero3];
$viaje1->setPasajeros($array1);
$array2 = [$pasajero2, $pasajero3, $pasajero1];
$viaje2->setPasajeros($array2);
$array3 = [$pasajero3, $pasajero2, $pasajero1];
$viaje3->setPasajeros($array3);
//
$arrayViajes = [$viaje1, $viaje2, $viaje3];
$empresa1->setArrayViajes($arrayViajes);
 

$finalizar = true;
do {
    echo menuPrincipal();
    $opcionPrincipal = trim(fgets(STDIN));
    switch ($opcionPrincipal) {
        case '1':
            echo $empresa1->__toString();
            
            break;

        case '2':
            echo "Indique el número de viaje que desea modificar.\n";
            $numViaje = trim(fgets(STDIN));
            $posicion = buscarViaje($numViaje, $empresa1);
            if($posicion >= 0){
                $arrayViaje = $empresa1->getArrayViajes();
                $objViaje = $arrayViaje[$posicion];
                $arrayViaje[$posicion] = nuevoViaje($objViaje);
                $empresa1->setArrayViajes($arrayViaje);
            }else{
                echo "No se ha encontrado el viaje.\n";
            }
            break;

        case '3':
            echo "Se venderá un viaje a la persona: \n
            {$pasajero4->__toString()}";
            $importe = $empresa1->venderPasaje($pasajero4);
            if($importe != null){
                echo "El importe es $ {$importe}.\n";
            }else{
                echo "No se ha podido vender el viaje.\n";
            }
            break;

        default:
            $finalizar = false;
            break;
    }
} while ($finalizar);


function nuevoViaje($objViaje){
$corte = true;
do{
    echo menu();
    $opcion = trim(fgets(STDIN));

    switch($opcion){
        case '1':
            echo "El codigo es: ".$objViaje->getCodViaje(). "\n";
            echo "Ingrese el nuevo codigo: \n";
            $codigoNuevo = trim(fgets(STDIN));
            $objViaje->setCodViaje($codigoNuevo);
            echo "el nuevo codigo es: ".$objViaje->getCodViaje();
            break;

        case '2':
            echo "El destino es: ".$objViaje->getDest(). "\n";
            echo "Ingrese el nuevo destino \n";
            $destinoNuevo = trim(fgets(STDIN));
            $objViaje->setDest($destinoNuevo);
            echo "el nuevo destino es: ".$objViaje->getDest();
            break;

        case '3':
            echo "La cantidad de pasajeros es de: ".$objViaje->getCantMaxPasajeros()."\n";
            echo "Ingrese la nueva cantidad de pasajeros: \n";
            $nuevaCantidad = trim(fgets(STDIN));
            $objViaje->setcatMaxPasajeros($nuevaCantidad);
            echo "La nueva cantidad maxima es de: ". $objViaje->getCantMaxPasajeros();
            break;

        case '4':
            echo "Ingrese los datos de un pasajero: \n";
            $objPasajero = datosPasajeros();
            if($objViaje->agregarPasajero($objPasajero)){
                echo "El pasajero fue agregado con exito";
            
            }else{
                echo "El pasajero ya se encuentra en el viaje";
            }
            break;

        case '5':
        
            echo "Ingrese el Dni del pasajero a modificar:\n ";
            $dniPasajero = trim(fgets(STDIN));

            if($objViaje->modificarPasajero($dniPasajero)){
                echo "Se ha modificado al pasajero";
            }else{
                echo "Pasajero no encontrado ";
            }
            break;

        case '6':
            echo $objViaje;
            break;

        case '7':
            $responsable = $objViaje->getResponsableViaje();
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
            $objViaje->setResponsableViaje($objResponsable);
            break;


        default:
            $corte = false;
            break;
    }
}while ($corte);
return $objViaje;
}



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


function menuPrincipal()
{
    $cadena = "Elija una opción:\n
    1. Ver viajes de la empresa.\n
    2. Cambiar datos de un viaje.\n
    3. Vender un viaje a una persona.\n
    4. Salir.\n";
    return $cadena;
}



function buscarViaje($numeroViaje, $empresa){
    $noEncontrado = true;
    $arrayViajes = $empresa->getArrayViajes();
    $count = count($arrayViajes);
    $contador = 0;
    while ($noEncontrado && $contador < $count) {
        $viajeN = $arrayViajes[$contador];
        $numero = $viajeN->getCodViaje();
        if($numero == $numeroViaje){
            $noEncontrado = false;
            $posicion = $contador;
        }
    }
    if($noEncontrado){
        $posicion = null;
    }
    return $posicion;    
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
