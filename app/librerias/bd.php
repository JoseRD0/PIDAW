<?php

class bd { //ESTA clase se encargará de 'toda' las interaccinoes con la BD

    //los nombres de las variables se explican a si mismos jaja
    private $host = DB_HOST;
    private $nombreDB = DB_NAME;
    private $usuario = DB_USER;
    private $password = DB_PASSWORD;

    private $conexionDB;
    private $statementDB;
    private $errorDB;
///////////////////////////////////////////////////////////////////7


    public function __construct()
    {
        $dns = 'mysql:host' . $this->host . ';nombreBD=' . $this->nombreBD;
        //control de erroes
        $option = [
            PDO::ATTR_ERRMODE => true, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //lanza exccptions
        ];

        try {
            $this->conexionDB = new PDO($dns , $this->usuario, $this->password , $option);
            $this->conexionDB->exec('set names ut8'); //que al conectar a lA BD esté en español de españa muy español

        } catch (PDOException $e) {
            $this->error = $e -> getMessage(); //pues eso, coge la excepción en caso de que haya y la imprime
            echo $this->error;
        }


    }

    public function query($sql){
    //recibe los queries sql

        return $this->statementDB = $this->conexionDB->prepare($sql);
        //el prepare() es lo mismo que en el java dbc lo de las ? ? ? interrogaciones, 
        //dejas en stand-by las queries(con campos no definidos todavia) para ejecutarlas mas tarde
        //en mi caso, con execute()


    }

    public function bind($parametro, $valor, $tipo = null){
    //va a identificar el tipo de los queries que le lleguen de query()

        if(is_null($tipo)){ //si el tipo es nulo crea switch, y dependiendo de que tupo de dato le llegue creara un PDO de ese tipo de dato
            switch(true){
                case is_int($valor);
                    $tipo = PDO::PARAM_INT;
                    break;

                case is_null($valor);
                    $tipo = PDO::PARAM_NULL;
                    break;

                case is_bool($valor);
                    $tipo = PDO::PARAM_BOOL;
                    break;

                default;
                    $tipo = PDO::PARAM_STR;
                    break;
            }
        }


    }

    public function execute(){
    //ejecute la query que sea
        return $this-> statementDB->execute();
    }

    public function registers(){
    //llama a los regstros con un fetch(funcion disponibles cuando se usan PDO "PHP Data Objects" )
        $this-> execute();
        return $this-> statementDB->fetchAll(PDO::FETCH_OBJ);
            //cuando solo se vaya a ejecutar se usa la funct de arriba, pero cuando
        //se va a ejectar y a recuperar todos los registros hace falta un fetch

    }

    public function register(){
        $this-> execute();
        return $this-> statementDB->fetch(PDO::FETCH_OBJ);

    }

    public function rowCount(){
    //cuenta lsa filas de la base de datos
        $this-> execute();
        return $this-> statementDB->rowCount();
    }






















}