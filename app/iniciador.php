<?php

//llamar a congif
require_once 'config/config.php';

//llamar a helpers (sirve para redireccionar siempre a pantalla principal)
require_once 'helpers/urlhelper.php';

//llamar a librerias(uso función que sirve para llamar a todos archivos da igual cuantos haya )
spl_autoload_register(function ($files) {
    require_once 'librerias/' . $files . '.php';
});
