<?php

include_once URL_APP . '/vistas/marcas/header.php';

?>

<div class="container-center center">
    <div class="container-content center">
        <div class="content-action center">
            <h4>Registro</h4>
            <form action="<?php echo URL_PROJECT ?>/home/register" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <button class="btn-red btn-block">Registrarme</button>
            </form>
            <div class="contenido-link mt-2">
                <span class="mr-2">Iniciar Sesión</span><a href="<?php echo URL_PROJECT?>/home/login">Entrar</a>
            </div>
        </div>
        <div class="content-image center">
            <img src="<?php echo URL_PROJECT ?>/img/vector.png" alt="man sentado en pc">
        </div>
    </div>
</div>

<?php

include_once URL_APP . '/vistas/marcas/footer.php';

?>