<?php
namespace ControlHorasExtras\PHP_MVC;
use PhpAnsiColor\Color;


class Service{

	
    private $config;
    public $vinculo;

    public function __construct(){
        // the connection configuration
        
        $config = json_decode(file_get_contents("../config.json"), true);
        
        $dbParams = $config["database"][0];

        $_vinculo = pg_connect("host={$dbParams["host"]} port={$dbParams["port"]} dbname={$dbParams["dbname"]} user={$dbParams["user"]} password={$dbParams["password"]}");

        if($_vinculo){
            $this->vinculo = $_vinculo;
        }
        else{
            error_log(Color::set(" - Conexion a Postgres fallo!!!!", "red+bold"));            
        }

        
    }

    
}
?>
