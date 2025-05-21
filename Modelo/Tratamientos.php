<?php
class Tratamientos
{
    private $numero;
    private $identificacion;
    private $fechasig;
    private $descripcion;
    private $fechaini;
    private $fechafin;
    private $observaciones;
    public function __construct($num, $ide, $fec, $des, $fIn, $fFin, $obs)
    {
        $this->numero = $num;
        $this->identificacion = $ide;
        $this->fechasig = $fec;
        $this->descripcion = $des;
        $this->fechaini = $fIn;
        $this->fechafin = $fFin;
        $this->observaciones = $obs;
    }
    public function obtenerNumero()
    {
        return $this->numero;
    }
    public function obtenerIdentificacion()
    {
        return $this->identificacion;
    }
    public function obtenerFechasignacion()
    {
        return $this->fechasig;
    }
    public function obtenerDescripcion()
    {
        return $this->descripcion;
    }
    public function obtenerFechaInicio()
    {
        return $this->fechaini;
    }
    public function obtenerFechaFin()
    {
        return $this->fechafin;
    }
    public function obtenerObservaciones()
    {
        return $this->observaciones;
    }
}
