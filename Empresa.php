<?php
class Empresa{
    private $nombre;
    private $arrayViajes;

    public function __construct($nombreStr){
        $this->nombre = $nombreStr;
        $this->arrayViajes = [];
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getArrayViajes(){
        return $this->arrayViajes;
    }
    public function setArrayViajes($arrayViajes){
        $this->arrayViajes = $arrayViajes;
    }

    private function arrayString(){
        $cadena = "";
        $arrayViajes = $this->getArrayViajes();
        foreach ($arrayViajes as $key => $value) {
            $viaje = $value;
            $strViaje = $viaje->__toString();
            $cadena .= $strViaje;
        }
        return $cadena;
    }

    public function __toString(){
        $strViajes = $this->arrayString();
        $cadena = "
        Nombre: {$this->getNombre()}.\n
        $strViajes\n";
        return $cadena;
    }

    /**Metodo para vender un pasaje
     * @param object $objPasajero
     * @return float
     */
    public function venderPasaje($objPasajero){
        $importeFinal = null;
        $arrayViajes = $this->getArrayViajes();
        $count = count($arrayViajes);
        //Buscar viaje con lugar
        $contador = 0;
        $noEncontrado = true;
        $posicion = null;
        while ($noEncontrado && $contador < $count) {
            $viaje = $arrayViajes[$contador];
            $hayLugar = $viaje->hayPasajesDisponible();
            if($hayLugar){
                $noEncontrado = false;
                $posicion = $contador;
            }
        }
        if(!$noEncontrado){
            $agregado = $viaje->agregarPasajero($objPasajero);
            if($agregado){
                $importeFinal = $viaje->calcularImporte();
                $arrayViajes[$posicion] = $viaje;
                $this->setArrayViajes($arrayViajes);
            }
        }
        return $importeFinal;
    }


}