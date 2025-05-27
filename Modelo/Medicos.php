<?php
class Medico
{
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $contraseña;
    public function __construct($ide, $nom, $ape, $contr)
    {
        $this->identificacion = $ide;
        $this->nombres = $nom;
        $this->apellidos = $ape;
        $this->contraseña = $contr;
    }
    public function obtenerIdentificacion()
    {
        return $this->identificacion;
    }
    public function obtenerNombres()
    {
        return $this->nombres;
    }
    public function obtenerApellidos()
    {
        return $this->apellidos;
    }
    public function obtenerContraseña()
    {
        return $this->contraseña;
    }
}