<?php

include_once URL_APP . '/vistas/marcas/header.php';

include_once URL_APP . '/vistas/marcas/navbar.php';



?>

<div class="container mt-3">
    <div class="row">
        <!-- Columna perfil -->
        <div class="col-md-3">
            <div class="container-style-main">
                <div class="perfil-usuario-main">
                    <div class="background-usuario-main"></div>
                    <div class="foto-separation"></div>
                    <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>" class="links">
                        <div class="text-center nombre-perfil"><?php echo $datos['perfil']->nombreCompleto ?></div>
                    </a>
                    <div class="tabla-estadisticas">
                        <a href="#">Publicaciones <br> 0 </a>
                        <a href="#">Me gustas <br> 0 </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Columna principal -->
        <div class="col-md-6">
            <div class="container-style-main">
                <div class="container-usuario-publicar">
                    <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>"></a>
                    <form action="<?php echo URL_PROJECT ?>/publicaciones/publicar/<?php echo $datos['usuario']->idusuario ?>" method="POST" enctype="multipart/form-data" class="form-publicar ml-2">
                        <textarea name="contenido" id="contenido" class="published mb-0" name="post" placeholder="Que estas pensando?" required></textarea>
                        <div class="image-upload-file">
                            <div class="upload-photo">
                                <img src="<?php echo URL_PROJECT ?>/img/image.png" alt="" class="image-public">
                                <div class="input-file">
                                    <input type="file" name="imagen" id="imagen">
                                </div>
                                <span class="ml-1">Subir foto</span>
                            </div>
                            <button class="btn-publi">Publicar</button>
                        </div>
                    </form>
                </div>
                <?php



                foreach ($datos['publicaciones'] as $datosPublicacion) : ?>
                    <div class="container-usuarios-publicaciones">
                        <div class="usuarios-publicaciones-top">
                            <div class="informacion-usuario-publico">
                                <h6 class="mb-0"><a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosPublicacion->usuario ?>"><?php echo ucwords($datosPublicacion->usuario) ?></a></h6>
                                <span><?php echo $datosPublicacion->fechaPublicacion ?></span>
                            </div>
                            <?php if ($datosPublicacion->idusuario == $_SESSION['logueado']) : ?>
                                <div class="acciones-publicacion-usuario">
                                    <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminar/<?php echo $datosPublicacion->idpublicacion ?>"><i class="far fa-trash-alt"></i></a>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="contenido-publicacion-usuario">
                            <p class="mb-1"><?php echo $datosPublicacion->contenidoPublicacion ?></p>
                        </div>
                        
                    </div>



                <?php endforeach ?>         <!--por cada publicación generará un bloqye nuevo usando nuevos datos publicación-->

            </div>
        </div>
        <!-- Columna eventos -->
        <div class="col-md-3">
            <div class="container-style-main">

            </div>
        </div>
    </div>
</div>


<?php

include_once URL_APP . '/vistas/marcas/footer.php';

?>