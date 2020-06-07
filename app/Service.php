<?php
namespace ControlHorasExtras\PHP_MVC;
use PhpAnsiColor\Color;


class Service{

	
    private $config;
    public $vinculo;

    public function __construct(){
        // the connection configuration
        $dbParams = array(
            'driver'   => 'pdo_pgsql',
            'user'     => 'postgres',
            'password' => '12345678',
            'dbname'   => 'HorasExtras',
            'host'     => 'localhost',
            'port'     => '5433',
        );

        
        
        
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
