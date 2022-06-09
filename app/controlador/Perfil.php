<?php

class Perfil extends controlador
{
    
    public function __construct()
    {
        $this->perfil = $this->model('perfilUsuario');
        $this->usuario = $this->model('usuario');
        $this->publicaciones = $this->model('publicar');
    }

    public function index($user)
    {
        if(isset($_SESSION['logueado'])) {

            $datosUsuario = $this->usuario->getUsuario($user);
            $datosPefil = $this->usuario->getPerfil($datosUsuario->idusuario);

            $datos = [
                'perfil' => $datosPefil,
                'usuario' => $datosUsuario,
            ];

            $this->vista('pages/perfil/perfil' , $datos);
        }
    }

    public function cambiarImagen()
    {

        $carpeta = 'C:/wamp64/www/MyMangaTracker/public/img/imagenesPerfil/';
        opendir($carpeta);
        $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name']; 
        $ruta = $carpeta . $_FILES['imagen']['name'];
        copy($_FILES['imagen']['tmp_name'] , $ruta);

        $datos = [
            'idusuario' => trim($_POST['id_user']),
            'ruta' => $rutaImagen
        ];

        $imagenActual = $this->usuario->getPerfil($datos['idusuario']);

        unlink('C:/wamp64/www/MyMangaTracker/public/' . $imagenActual->fotoPerfil);
 
         if($this->perfil->editarFoto($datos)) {
             redirection('/home');
         } else {
             echo 'El perfil no se ha guardado';
         }
    }

}