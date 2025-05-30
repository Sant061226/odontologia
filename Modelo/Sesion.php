<?php
class Sesion
{
    private $identificacion;
    private $contrasena;
    private $rol;
    public function __construct($ide, $contr, $ro)
    {
        $this->identificacion = $ide;
        $this->contrasena = $contr;
        $this->rol = $ro;
    }
    public function obtenerIdentificacion()
    {
        return $this->identificacion;
    }
    public function obtenerContrasena()
    {
        return $this->contrasena;
    }
    public function obtenerRol()
    {
        return $this->rol;
    }
}
