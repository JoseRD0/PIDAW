<?php

class Core
{
    protected $currentController = 'home';
    protected $currentMethod = 'index'; // este metodo lleva al index
    protected $parameters = [];
    //es un array porque puede habar muchos paramettros

    public function __construct()
    //en una clase que tenga un constructor como esta, cada vez que se cree objeto de la clase 'Core' se invocará el 
    //constructor
    {
        $url = $this->getUrl(); //$this se usa cuando un metodo es invocado dentro del contexto '{}' de un objeto
        //referencia al objeto invocador

        if (is_array($url)) { //uso la función is_array para comprobar que ES un array, pues si url está vacío devolvera 'false'
            if (file_exists('../app/controlador/' . ucwords($url[0]) . '.php')) //ucwords convierte las 1as letras de palabra a mayus
            {

                $this->currentController = ucwords($url[0]);

                unset($url[0]); //unset elimina el mvalor almacenado en la var

            }
        } else {
            //valor falso, array completamente vacío
        }



        require_once '../app/controlador/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController; //de estas 2 lineas no se mucho que hacen, no lo comprendo, solo seguí pasos
        //para llamar metodos se hace la siguiente condicióon
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) { //validar si exsite metodo en la url (la pos 1)
                $this->currentMethod = $url[1];

                unset($url[1]); //unset() elimina el valor almacenado de la variable 
            }
        }

        //llamar parametros
        $this->parameters = $url ? array_values($url) : []; //parametros va a ser igual a lo que haya en $url y si arrayvalues... no lo pillo
        //array_values devuelve un array indexeado de valores

        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
        //  no se muy bien qué hace la función pero según documentación "Llamar a una llamada de retorno con un array de parámetros"

    }

    public function getUrl()
    { //isset = existe?

        if (isset($_GET['url'])) { // 'url' porque en htaccess puse una regla de que siuempre nos lleve al index.pho y que todo lo pase por el metodo 'url' con todos los parametres (por eso '$1')
            $url = rtrim($_GET['url'], '/');
            //creacion de var url separada por barras '/'
            //como por ejemplo localhost/MymangaTracker, está separado por barras

            $url = filter_var($url, FILTER_SANITIZE_URL);
            //filtrar las barras, eliminando todos los caracteres no validos del string, en este caso la url

            $url = explode('/', $url);
            //rompe una string en un array
            //por ejemplo: 'Hola que tal' seria--> [0]=Hola, [1]=que, ...

            return $url;
        }
    }
}
