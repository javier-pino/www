<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			/* La siguiente configuración corresponde a la base de datos en localhost*/
                'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=neo_eldescuenton',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                      ),			
		),
	)
);
