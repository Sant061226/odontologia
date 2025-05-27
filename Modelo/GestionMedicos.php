<?php
class GestionMedicos
{
    public function verificarUsuario($identificacion, $contrasena, $rol)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM medicos WHERE identificacion = '$identificacion' AND rol = '$rol'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $usuario = $result->fetch_object();
        $conexion->cerrar();

        if ($usuario && password_verify($contrasena, $usuario->contrasena)) {
            return $usuario;
        } else {
            return false;
        }
    }
}