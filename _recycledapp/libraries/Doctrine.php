<?php
use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ArrayCache,
    Doctrine\DBAL\Logging\EchoSQLLogger;

define('DEBUGGING', FALSE);
if (!defined('ENVIRONMENT')) 
    define('ENVIRONMENT', 'development');

class Doctrine {

	public $em = null;

	public function __construct()
	{
		// load database configuration and custom config from CodeIgniter
		require APPPATH . 'config/database.php';
                                

                // Set up class loading. You could use different autoloaders, provided by your favorite framework,
                // if you want to.
                require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';

                $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'libraries');
                $doctrineClassLoader->register();
                $entitiesClassLoader = new ClassLoader('Entities', APPPATH.'models/');
                $entitiesClassLoader->register();
                $proxiesClassLoader = new ClassLoader('Proxies', APPPATH.'models/');
                $proxiesClassLoader->register();
               
		// Choose caching method based on application mode
		//if (ENVIRONMENT == 'production') {
		//	$cache = new \Doctrine\Common\Cache\ApcCache;                        
                //} else {
			$cache = new \Doctrine\Common\Cache\ArrayCache;
		//}
                
		// Set some configuration options
		$config = new Configuration;

		// Metadata driver
		$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));	
		$config->setMetadataDriverImpl($driverImpl);

		// Caching
		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);

		// Proxies
		$config->setProxyDir(APPPATH . 'models/Proxies');
		$config->setProxyNamespace('Proxies');

		if (ENVIRONMENT == 'development') {
			$config->setAutoGenerateProxyClasses(TRUE);
		} else {
			$config->setAutoGenerateProxyClasses(FALSE);
		}

		// SQL query logger
		if (DEBUGGING)
		{
			$logger = new \Doctrine\DBAL\Logging\EchoSQLLogger;
			$config->setSQLLogger($logger);
		}

		// Database connection information
		$connectionOptions = array(
			'driver'		=> 'pdo_mysql',
			'user'			=> $db[$active_group]['username'],
			'password'		=> $db[$active_group]['password'],
			'host'			=> $db[$active_group]['hostname'],
			'dbname'		=> $db[$active_group]['database'],
			'charset'		=> $db[$active_group]['char_set'],
			'driverOptions'	=> array( 
				'charset' 	=> $db[$active_group]['char_set']
			)
		);

		// Create EntityManager
		$this->em = EntityManager::create($connectionOptions, $config);
	}
}
