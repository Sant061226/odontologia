<?php
class GestorSesion
{
    public function verificarUsuario(Sesion $sesion)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $identificacion = $sesion->obtenerIdentificacion();
        $contrasena = $sesion->obtenerContrasena();
        $rol = $sesion->obtenerRol();
        $usuario = false;
        if ($rol == 1) {
            $sql = "SELECT * FROM medicos WHERE MedIdentificacion = '$identificacion'";
            $conexion->consulta($sql);
            $result = $conexion->obtenerResult();
            $usuario = $result->fetch_object();
            $usuario && password_verify($contrasena, $usuario->MedContrasena);
            $conexion->cerrar();
            return $usuario;
        } elseif ($rol == 2) {
            $sql = "SELECT * FROM pacientes WHERE PacIdentificacion = '$identificacion'";
            $conexion->consulta($sql);
            $result = $conexion->obtenerResult();
            $usuario = $result->fetch_object();
            $usuario && password_verify($contrasena, $usuario->PacContrasena);
            $conexion->cerrar();
            return $usuario;
        } elseif ($rol == 3) {
            $sql = "SELECT * FROM administradores WHERE AdIdentificacion = '$identificacion'";
            $conexion->consulta($sql);
            $result = $conexion->obtenerResult();
            $usuario = $result->fetch_object();
            $usuario && password_verify($contrasena, $usuario->AdContrasena);
            $conexion->cerrar();
            return $usuario;
        }
        $conexion->cerrar();
        return false;
    }
}
