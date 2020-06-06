<?php

namespace ErikvdVen\PHP_MVC;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

final class Service
{

	private $dbParams;
	private $config;

    private function __construct()
    {

        $paths = array(dirname(__FILE__)."/Models");
        $isDevMode = false;

        // the connection configuration
        $this->dbParams = array(
            'driver'   => 'pdo_pgsql',
            'user'     => 'postgres',
            'password' => '12345678',
            'dbname'   => 'HorasExtras',
            'host'     => 'localhost',
            'port'     => '5433',
        );

        $this->config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        
    }

    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $service = new Service();
            $inst = EntityManager::create($service->dbParams, $service->config);
        }
        return $inst;
    }
}
?>
