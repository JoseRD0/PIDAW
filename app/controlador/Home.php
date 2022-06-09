<?php
require_once '../app/modelo/usuario.php';
class Home extends controlador //extiendo al controler para poder usar sus metodos
{//un metodo es una funcion usada en el contexto de una clase u obj, si está fuera se llama funciójn
    public function __construct()
    {
        $this->usuario = $this->model('usuario');//aqui creamos todas las opciones del usuario, registro, logeo...
    }
public function index()
{
  //$this->vista('paginas/login'); //PRUEBA para ver que encuentra la interfaz

    if (isset($_SESSION['logueado'])) {

        $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
        $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);

        $datosPublicaciones = $this->publicaciones->getPublicaciones();

        $verificarLike = $this->publicaciones->misLikes($_SESSION['logueado']);

        if ($datosPerfil) {
            $datosRed = [
                'usuario' => $datosUsuario,
                'perfil' => $datosPerfil,
                'publicaciones' => $datosPublicaciones,
                'misLikes' => $verificarLike
            ];

            $this->vista('paginas/home', $datosRed);
        } else {
            $this->vista('paginas/perfil/completarPerfil', $_SESSION['logueado']);
        }
    } else {
        redirection('/home/login');
    }
}

public function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $datosLogin = [
            'usuario' => trim($_POST['usuario']),
            'contrasena' => trim($_POST['contrasena'])
        ];

        $datosUsuario = $this->usuario->getUsuario($datosLogin['usuario']);

        if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin['contrasena'])) {
            $_SESSION['logueado'] = $datosUsuario->idusuario;
            $_SESSION['usuario'] = $datosUsuario->usuario;
            redirection('/home');
        } else {
            $_SESSION['errorLogin'] = 'El usuario o la contraseña son incorrectos';
            redirection('/home');
        }
    } else {
        if (isset($_SESSION['logueado'])) {
            redirection('/home');
        } else {
            $this->vista('paginas/login-register/login');
        }
    }
}

public function register()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $datosRegistro = [
            'privilegio' => '2',
            'email' => trim($_POST['email']),
            'usuario' => trim($_POST['usuario']),
            'contrasena' => password_hash(trim($_POST['contrasena']), PASSWORD_DEFAULT)
        ];

        if ($this->usuario->verificarUsuario($datosRegistro)) {
            if ($this->usuario->register($datosRegistro)) {
                $_SESSION['loginComplete'] = 'Tu registro se ha completado satisfactoriamente, ahora puedes entrar';
                redirection('/home');
            } else {}
        } else {
            $_SESSION['usuarioError'] = 'El usuario no esta disponible';
            $this->vista('paginas/login-register/register');
        }
    } else {
        if (isset($_SESSION['logueado'])) {
            redirection('/home');
        } else {
            $this->vista('paginas/login-register/register');
        }
    }
}


public function insertarRegistrosPerfil()
{
    $carpeta = 'C:/wamp64/www/MyMangaTracker/public/img/imagenesPerfil/';
    opendir($carpeta);
    $rutaImagen = 'img/imagenesPerfil/' . $_FILES['imagen']['name'];
    $ruta = $carpeta . $_FILES['imagen']['name'];
    copy($_FILES['imagen']['tmp_name'], $ruta);

    $datos = [
        'idusuario' => trim($_POST['id_user']),
        'nombre' => trim($_POST['nombre']),
        'ruta' => $rutaImagen
    ];

    if ($this->usuario->insertarPerfil($datos)) {
        redirection('/home');
    } else {
        echo 'El perfil no se ha guardado';
    }
}

public function logout()
{
    session_start();

    $_SESSION = [];

    session_destroy();

    redirection('/home');
}

public function usuarios()
{
    if (isset($_SESSION['logueado'])) {

        $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
        $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
        $usuariosRegistrados = $this->usuario->getAllUsuarios();
        $cantidadUsuarios = $this->usuario->getCantidadUsuarios();

        if ($datosPerfil) {
            $datosRed = [
                'usuario' => $datosUsuario,
                'perfil' => $datosPerfil,
                'allUsuarios' => $usuariosRegistrados,
                'cantidadUsuarios' => $cantidadUsuarios
            ];
            $this->vista('paginas/usuarios/usuarios', $datosRed);
        } else {
            redirection('/home');
        }
    }
}

public function buscar()
{
    if (isset($_SESSION['logueado'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $busqueda = '%' . trim($_POST['buscar']) . '%';
            $datosBusqueda = $this->usuario->buscar($busqueda);

            
            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $datosPerfil = $this->usuario->getPerfil($_SESSION['logueado']);
            $misNotificaciones = $this->publicaciones->getNotificaciones($_SESSION['logueado']);
            $misMensajes = $this->publicaciones->getMensajes($_SESSION['logueado']);


            if ($datosPerfil) {
                $datosRed = [
                    'usuario' => $datosUsuario,
                    'perfil' => $datosPerfil,
                    'resultado' => $datosBusqueda
                ];

                if ($datosBusqueda) {
                    $this->vista('paginas/busqueda/buscar' , $datosRed);
                } else {
                    redirection('/home');
                }
            } else {
                redirection('/home');
            }
        } else {
            redirection('/home');
        }
    }
}
}
