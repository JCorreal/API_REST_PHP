<?php // Interface que expone todo lo que el DAL (Capa Acceso Datos) implementa

interface IAccesoDatos {
    public function ListaUsuarios();
    public function ObtenerUsuario($DatoBuscar);
    public function GuardarUsuario($usuario);
    public function EliminarUsuario($DatoEliminar);
}
