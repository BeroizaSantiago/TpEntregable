<?php
class Viaje {
    //atributos
    private $codViaje;
    private $dest;
    private $cantMaxPasajeros;
    private $pasajeros = []; 

    //constructor
    public function __construct($codigo, $destino,$cantidadMaxima){
    $this->codViaje = $codigo;
    $this->dest = $destino;
    $this->cantMaxPasajeros = $cantidadMaxima; 
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


    public function agregarPasajero($pasajeroMod){
        $retorno = false;   
        $arrayInt = $this->getPasajeros();
        /*in_array se utiliza para comprobar si el array 
        $pasajero se encuentra el la lista de pasajeros */
        if(in_array($pasajeroMod, $this->getPasajeros())){
            $retorno = false;
        }else{
            array_push($arrayInt, $pasajeroMod);
            $this->setPasajeros($arrayInt);
            $retorno = true;
        }
        return $retorno; 
    }

    public function modificarPasajero($pasajero1,$pasajero2){
        /*$pasajeroInterno es un array que se guarda con los 
        valores del ultimo array creado*/
        $retorno = false;
        $pasajeroInterno = $this->getpasajeros(); 
    
        if(in_array($pasajero1, $pasajeroInterno)){
            //array_search utilizado para encontrar la clave donde coinciden los datos
            $k = array_search($pasajero1,$pasajeroInterno );
            $pasajeroInterno[$k]= $pasajero2;
            $this->setPasajeros($pasajeroInterno);
            $retorno = true;
        }return $retorno;
    }
        private function pasajerosString(){
            $datosPasajeros = "";
            foreach ($this->getPasajeros() as $k => $value) {
                $nombre = $value['nombre'];
                $apellido = $value['apellido'];
                $dni = $value['dni'];
                $datosPasajeros .= "
                Nombre: $nombre.\n
                Apellido: $apellido.\n
                DNI: $dni.\n";
            }
            return $datosPasajeros;
        }

    public function __toString()
    {
        $pasajeros = $this->pasajerosString();
        $arrayPasajeros = $this->getPasajeros();
        $cantidad = count($arrayPasajeros);
        $cadena = 
        "Codigo de viaje:" .$this->getCodViaje()."\n".
        "Destino:". $this->getDest(). "\n".
        "Capacidad maxima: ".$this->getCantMaxPasajeros()."\n".
        "Asientos ocupados: ".$cantidad."\n".
        "Datos de Pasajeros: ". $pasajeros;

        return $cadena;
    }

}

