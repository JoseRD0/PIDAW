<?php

class controlador{ //se encargará de llamar a los *modelos* y a las *vistas*

    public function model($modelo){//recibira varable modelo y ejecutará la llamada en si 
        require_once '../app/modelo/' . $modelo . '.php';//vamos a requerir los archivos que acaben en .php de modelo/ 

        return new $modelo;


    }


    public function vista($vista , $datos = []){//lo mismo todo que con modelo peor con una datos almacenados en un array como parametro extra, es bueno ponerlo por si acaso segun tutoriales 

        //si llamamos a una vista inexistente --> dar error 404
        if(file_exists('../app/vistas/' . $vista . '.php')){

            require_once '../app/vistas/' . $vista . '.php';
           // echo 'la vista SI existe';

        }else{
            echo 'ERR404 la vista es NO existe';
        }



    }


}