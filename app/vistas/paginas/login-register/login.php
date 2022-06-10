<?php

include_once URL_APP . '/vistas/marcas/header.php';

//include_once URL_APP . '/vistas/marcas/navbar.php';


?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h4>Iniciar sesión</h4>
            <form action="<?php echo URL_PROJECT ?>/home/login" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button class="btn-red btn-block">Entrar</button>
            </form>

            <div class="contenido-link mt-2">
                <span class="mr-2">¿No estás registrado?</span><a href="<?php echo URL_PROJECT?>/home/register">Crear cuenta</a>
            </div>
        </div>
        <div class="content-image center">
            <img src="<?php echo URL_PROJECT ?>/img/vector.png" alt="logo">
        </div>
    </div>
</div>


<?php

include_once URL_APP . '/vistas/marcas/footer.php';


?>