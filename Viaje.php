<?php
class Viaje {
    //atributos
    private $codViaje;
    private $dest;
    private $cantMaxPasajeros;
    private $pasajeros = []; 
    private $responsableViaje;

    //constructor
    public function __construct($codigo, $destino,$cantidadMaxima,$responsable){
    $this->codViaje = $codigo;
    $this->dest = $destino;
    $this->cantMaxPasajeros = $cantidadMaxima; 
    $this->responsableViaje = $responsable;
    }

    //get - set
    public function getCodViaje(){
        return $this->codViaje;
    }

    public function setCodViaje($cod){
        $this->codViaje = $cod;
    }
    public function getDest(){
        return $this->dest;
    }

    public function setDest($destino){
        $this->dest = $destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function setcatMaxPasajeros($cantMaxima){
        $this->cantMaxPasajeros = $cantMaxima;
    }

    public function getpasajeros(){
        return $this->pasajeros;
    }
    public function setPasajeros($arrayPasajeros){
        $this->pasajeros = $arrayPasajeros;
    }
    public function getResponsableViaje(){
        return $this->responsableViaje;
    }
    public function setResponsableViaje($responsable){
        $this->responsableViaje = $responsable;
    }


    public function agregarPasajero($objPasajero){
        $retorno = false;   
        $colecPasajeros = $this->getPasajeros();
        $cantPasajeros = count($colecPasajeros);
        $noEcontrado = true;
        $i = 0;
        $dniPrueba = $objPasajero->getDni();
        while($noEcontrado && $i < $cantPasajeros){
            $pasajeroSelec = $colecPasajeros[$i];
            $dniSelec = $pasajeroSelec->getDni();
            if($dniSelec == $dniPrueba){
                $noEcontrado = false;
            }
            $i++;
        }
        if($noEcontrado){
            $retorno = true;
            $cantPasajeros = count($colecPasajeros);
            if($cantPasajeros == 0){
                $colecPasajeros[0] = $objPasajero;
            }else{
                $colecPasajeros[$cantPasajeros] = $objPasajero;
            }
            $this->setPasajeros($colecPasajeros);
        }else{
            $retorno = false;
        }

        return $retorno;

        /*
        /*in_array se utiliza para comprobar si el array 
        $pasajero se encuentra el la lista de pasajeros 
        if(in_array($pasajeroMod, $this->getPasajeros())){
            $retorno = false;
        }else{
            array_push($arrayInt, $pasajeroMod);
            $this->setPasajeros($arrayInt);
            $retorno = true;
        }
        return $retorno; */
    }

    public function modificarPasajero($dni){
        /*$pasajeroInterno es un array que se guarda con los 
        valores del ultimo array creado*/
        $retorno = false;
        $pasajeroInterno = $this->getpasajeros(); 
        $cantPas = count($pasajeroInterno);
        $noEcontrado = true;
        $i = 0;
        $posicion = 0;
        while($noEcontrado && $i < $cantPas){
            $pasajeroSelec = $pasajeroInterno[$i];
            $dniSelec = $pasajeroSelec->getDni();
            if($dni == $dniSelec){
                $noEcontrado = false;
                $posicion = $i;
                $retorno = true;
            }
            $i++;
        }

        if(!$noEcontrado){
            $objPasajero = $pasajeroInterno[$posicion];
            $this->modificacion($objPasajero);
            $pasajeroInterno[$posicion] = $objPasajero; 
        }

        return $retorno; 
    /*
        if(in_array($pasajero1, $pasajeroInterno)){
            //array_search utilizado para encontrar la clave donde coinciden los datos
            $k = array_search($pasajero1,$pasajeroInterno );
            $pasajeroInterno[$k]= $pasajero2;
            $this->setPasajeros($pasajeroInterno);
            $retorno = true;
        }return $retorno; */
    }
    private function pasajerosString(){
        $datosPasajeros = "";
        foreach ($this->getPasajeros() as $k => $value) {
            $objPasajero = $value;
            $datos = $objPasajero;
            $datosPasajeros .= $datos;
        }
            return $datosPasajeros;
    }

    private function modificacion($objPasajero){
        $menuModificar = "
        1. Modificar nombre.\n
        2. Modificar apellido.\n
        3. Modificar dni.\n
        4. Modificar telefono.\n
        5. Ver datos.\n
        6. Salir.\n";
        $salir = true;
        do {
            echo $menuModificar;
            $seleccion = trim(fgets(STDIN));
            switch ($seleccion) {
                case '1':
                    echo "Ingrese el nuevo nombre: \n";
                    $nuevoNombre = trim(fgets(STDIN));
                    $objPasajero->setNombre($nuevoNombre);
                    break;

                case '2':
                    echo "Ingrese el nuevo apellido: \n";
                    $nuevoApellido = trim(fgets(STDIN));
                    $objPasajero->setApellido($nuevoApellido);
                    break;

                case '3':
                    echo "Ingrese el nuevo dni: \n";
                    $nuevoDni = intval(trim(fgets(STDIN)));
                    $objPasajero->setDni($nuevoDni);
                    break;

                case '4':
                    echo "Ingrese el nuevo telefono: \n";
                    $nuevoTelefono = trim(fgets(STDIN));
                    $objPasajero->setTelefono($nuevoTelefono);
                    break;

                case '5':
                    echo $objPasajero;
                    break;
                
                default:
                    $salir = false;
                    break;
            }
        } while ($salir);
        return $objPasajero;

    }


    public function __toString()
    {
        $pasajeros = $this->pasajerosString();
        $arrayPasajeros = $this->getPasajeros();
        $cantidad = count($arrayPasajeros);
        $responsableDatos = $this->getResponsableViaje();
        $cadena = 
        "Codigo de viaje:" .$this->getCodViaje()."\n".
        "Destino:". $this->getDest(). "\n".
        "Capacidad maxima: ".$this->getCantMaxPasajeros()."\n".
        "Asientos ocupados: ".$cantidad."\n".
        "Pasajeros: ". $pasajeros.
        "Responsable: ". $responsableDatos;
        return $cadena;
    }

}

