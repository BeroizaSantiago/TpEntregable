<?php
class Pasajero{
    //Atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //Metodo Constructor
    public function __construct($nom,$apell,$dni,$tel){
        $this->nombre = $nom;
        $this->apellido = $apell;
        $this->dni = $dni;
        $this->telefono = $tel;
    }

    //Metodos de Accesos Get/Set
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nom){
        $this->nombre = $nom;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apell){
        $this->apellido = $apell;
    }
    public function getDni(){
        return $this->dni;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($tel){
        $this->telefono = $tel;
    }   

    //Metodo toString
    public function __toString(){
        $cadena = 
        "\n----Datos Pasajero----".
        "\nNombre: ". $this->getNombre().
        "\nApellido: ". $this->getApellido().
        "\nDNI: ". $this->getDni().
        "\nTelefono: ". $this->getTelefono().
        "\n----------------------\n";
        return $cadena;
    }

    
}