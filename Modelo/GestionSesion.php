<?php
class GestorSesion{
public function verificarUsuario($identificacion, $contrasena, $rol)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM pacientes WHERE PacIdentificacion = '$identificacion'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $usuario = $result->fetch_object();
        $conexion->cerrar();
        if ($usuario && password_verify($contrasena, $usuario->PacContrasena)) {
            return $usuario;
        } else {
            return false;
        }
    }
}
?>