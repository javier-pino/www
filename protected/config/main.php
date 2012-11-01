<?php

// uncomment the following to define a path alias
 Yii::setPathOfAlias('movil','//modules/movil');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'TuDescuentón.com',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.entities.*',
                'application.models.forms.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
                // Descomentada esta linea para activar Gii		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'NewbdtdS3',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
                        // Se descomentó para que solo permita por localhost
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
                //Se agrega el módulo creado para móvil
              'movil' => array (
                  'defaultController' => 'promociones',                  
               ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
                // Se descomentó para activar las url en path format
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>
                            array(                            
                                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                            ),
		),                
		
                // uncomment the following to use a MySQLite database
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/                        
            
                //Configuracion de la base de datos de producción
                'db'=>array(			
			'connectionString' => 'mysql:host=mytudescuentonnew.cjqilh8qt90d.us-east-1.rds.amazonaws.com;dbname=neo_eldescuenton',
			'emulatePrepare' => true,
			'username' => 'tudescuenton',
			'password' => 'NewbdtdS3',
			'charset' => 'utf8',                        
		),		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);