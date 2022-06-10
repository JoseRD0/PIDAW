<?php

class Publicaciones extends controlador
{
    public function __construct()
    {
        $this->publicar = $this->model('publicar');
    }

    public function publicar($idUsuario)
    {

        if (isset($_FILES['imagen'])) {
            $carpeta = 'C:/wamp64/www/MyMangaTracker/public/img/imagenesPublicaciones/';
            opendir($carpeta);
            $rutaImagen = 'img/imagenesPublicaciones/' . $_FILES['imagen']['name'];
            $ruta = $carpeta . $_FILES['imagen']['name'];
            copy($_FILES['imagen']['tmp_name'], $ruta);
        } else {
            $rutaImagen = 'sin imagen';
        }

        $datos = [
            'iduser' => trim($idUsuario),
            'contenido' => trim($_POST['contenido']),
            'foto' => $rutaImagen
        ];

        if ($this->publicar->publicar($datos)) {
            redirection('/home');
        } else {
            echo 'algo ocurrio';
        }
    }

    public function eliminar($idpublicacion)
    {

        $publicacion = $this->publicar->getPublicacion($idpublicacion);


        if ($this->publicar->eliminarPublicacion($publicacion)) {
            unlink('C:/wamp64/www/MyMangaTracker/public/' . $publicacion->fotoPublicacion);
            redirection('/home');
        } else { }
    }

    public function megusta($idpublicacion, $idusuario , $idusaurioPropietario)
    {
        $datos = [
            'idpublicacion' => $idpublicacion,
            'idusuario' => $idusuario,
            'idusaurioPropietario' => $idusaurioPropietario
        ];

        $datosPublicacion = $this->publicar->getPublicacion($idpublicacion);

        if ($this->publicar->rowLikes($datos)) {
            if ($this->publicar->eliminarLike($datos)) { 
                $this->publicar->deleteLikeCount($datosPublicacion);
            }
            redirection('/home');
        } else {
            if ($this->publicar->agregarLike($datos)) { 
                $this->publicar->addLikeCount($datosPublicacion);
                $this->publicar->addNotificacionLike($datos);
            }
            redirection('/home');
        }
    }

    public function comentar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datos = [
                'iduserPropietario' => trim($_POST['iduserPropietario']),
                'iduser' => trim($_POST['iduser']),
                'idpublicacion' => trim($_POST['idpublicacion']),
                'comentario' => trim($_POST['comentario']),
            ];

            if ($this->publicar->publicarComentario($datos)) {
                $this->publicar->addNotificacionComentario($datos);
                redirection('/home');
            } else {
                redirection('/home');
            }
        } else {
            redirection('/home');
        }
    }

    public function eliminarComentario($id)
    {
        if ($this->publicar->eliminarComentarioUsuario($id)) {
            redirection('/home');
        } else {
            redirection('/home');
        }
    }
}
