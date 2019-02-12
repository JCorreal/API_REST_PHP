<?php // Interface que expone todo lo que el DAL (Capa Acceso Datos) implementa

interface IAccesoDatos {
    public function ObtenerListadoUsuarios();       // Obtiene el listado de todos los usuarios
    public function ObtenerUsuario($DatoBuscar);    // Obtiene un usuario
    public function GuardarUsuario($usuario);       // Ingresa y/o actualiza un usuario
    public function EliminarUsuario($DatoEliminar); // Elimina un usuario
}
