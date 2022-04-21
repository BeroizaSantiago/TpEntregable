<?php
class ResponsableV{
    private $nombre;
    private $apellido;
    private $nroEmpleado;
    private $nroLicencia;

    //Metodo Constructor
    public function __construct($nomb, $apell,$numEmpl,$numLic)
    {
     $this->nombre = $nomb;
     $this->apellido = $apell;
     $this->nroEmpleado = $numEmpl;
     $this->nroLicencia = $numLic;
    }

    //Metodos de Acceso Get/Set
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nomb){
        $this->nombre = $nomb;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apell){
        $this->apellido = $apell;
    }
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    public function setNroEmpleado($numEmpl){
        $this->nroEmpleado = $numEmpl;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function setNroLicencia($numLic){
        $this->nroLicencia = $numLic;
    }

    //Metodo toString
    public function __toString()
    {
        $cadena = 
        "\n----Datos Responsable----".
        "\nNombre: ". $this->getNombre().
        "\nApellido: ". $this->getApellido().
        "\nNumero de Empleado: ". $this->getNroEmpleado().
        "\nNumero de Licencia: ". $this->getNroLicencia().
        "\n-------------------------\n";
        return $cadena;

    }
}