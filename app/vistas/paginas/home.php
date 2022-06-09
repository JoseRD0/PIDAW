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
                    <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="">
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
                    <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datos['usuario']->usuario ?>"><img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" class="image-border " alt=""></a>
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
                <?php foreach ($datos['publicaciones'] as $datosPublicacion) : ?>
                    <div class="container-usuarios-publicaciones">
                        <div class="usuarios-publicaciones-top">
                            <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPerfil ?>" alt="" class="image-border ">
                            <div class="informacion-usuario-publico">
                                <h6 class="mb-0"><a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosPublicacion->usuario ?>"><?php echo ucwords($datosPublicacion->usuario) ?></a></h6>
                                <span><?php echo $datosPublicacion->fechaPublicacion ?></span>
                            </div>
                            <?php if($datosPublicacion->idusuario == $_SESSION['logueado'] ): ?>
                            <div class="acciones-publicacion-usuario">
                                <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminar/<?php echo $datosPublicacion->idpublicacion ?>"><i class="far fa-trash-alt"></i></a>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="contenido-publicacion-usuario">
                            <p class="mb-1"><?php echo $datosPublicacion->contenidoPublicacion ?></p>
                            <img src="<?php echo URL_PROJECT . '/' . $datosPublicacion->fotoPublicacion ?>" alt="" class="imagen-publicacion-usuario">
                        </div>
                        <hr>
                        <div class="acciones-usuario-publicar mt-2">
                            <a href="<?php echo URL_PROJECT ?>/publicaciones/megusta/<?php echo $datosPublicacion->idpublicacion . '/' . $_SESSION['logueado'] . '/' . $datosPublicacion->idusuario?>" class="
                                            <?php foreach ($datos['misLikes'] as $misLikesUser) {
                                                if ($misLikesUser->idPublicacion == $datosPublicacion->idpublicacion) {
                                                    echo 'like-active';
                                                }
                                            } ?>
                                            "><i class="fas fa-heart mr-1"></i>Me gusta <span><?php echo $datosPublicacion->num_likes ?></span></a>
                        </div>
                        <hr>
                        <div class="formulario-comentarios">
                            <img src="<?php echo URL_PROJECT . '/' . $datos['perfil']->fotoPerfil ?>" alt="" class="image-border mr-2">
                            <div class="acciones-formulario-comentario">
                                <form action="<?php echo URL_PROJECT ?>/publicaciones/comentar" method="POST">
                                    <input type="hidden" name="iduserPropietario" value="<?php echo $datosPublicacion->idusuario ?>">
                                    <input type="hidden" name="iduser" value="<?php echo $datos['usuario']->idusuario ?>">
                                    <input type="hidden" name="idpublicacion" value="<?php echo $datosPublicacion->idpublicacion ?>">
                                    <input type="text" name="comentario" class="form-comentario-usuario" placeholder="Agregar un comentario" required>
                                    <div class="btn-comentario-container">
                                        <button class="btn-purple">Comentar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php foreach ($datos['comentarios'] as $datosComentarios) : ?>
                            <?php if ($datosComentarios->idPublicacion == $datosPublicacion->idpublicacion) : ?>
                                <div class="container-contenido-comentarios">
                                    <img src="<?php echo URL_PROJECT . '/' . $datosComentarios->fotoPerfil ?>" alt="" class="image-border mr-2">
                                    <div class="contenido-comentario-usuario">

                                        <?php if ($datosComentarios->iduser == $_SESSION['logueado']) : ?>
                                            <a href="<?php echo URL_PROJECT ?>/publicaciones/eliminarComentario/<?php echo $datosComentarios->idcomentario ?>" class="float-right"><i class="far fa-trash-alt"></i></a>
                                        <?php endif ?>

                                        <a href="<?php echo URL_PROJECT ?>/perfil/<?php echo $datosComentarios->usuario ?>" class="big mr-2"><?php echo $datosComentarios->usuario ?></a>

                                        <span><?php echo $datosComentarios->fechaComentario ?></span>
                                        <p><?php echo $datosComentarios->contenidoComentario ?></p>

                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>

                    </div>
                <?php endforeach ?>
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