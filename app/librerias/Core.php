<?php

class Core 
{
    protected $currentController = 'home';
    protected $currentMethod = 'index'; // este metodo lleva al index
    protected $parameters = [];
    //es un array porque puede habar muchos paramettros

    public function __construct()
    {
        
    }


    public function getUrl()
    {//isset = existe?
        if(isset($_GET['url'])){ // 'url' porque en htaccess puse una regla de que siuempre nos lleve al index.pho y que todo lo pase por el metodo 'url' con todos los parametres (por eso '$1')
            $url = rtrim($_GET['url'] , '/');
                //creacion de var url separada por barras '/'
                //como por ejemplo localhost/MymangaTracker, está separado por barras


            $url = filter_var($url , FILTER_SANITIZE_URL);
                //filtrar las barras, eliminando todos los caracteres no validos del string, en este caso la url
            $url = explode('/' , $url );
                //rompe una string en un array
                //por ejemplo: 'Hola que tal' seria--> [0]=Hola, [1]=que, ...

        }
    }

}