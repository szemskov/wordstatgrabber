<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Grabber Yandex Wordstat 1.0',

	// preloading 'log' component
	'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

	// application components
	'components'=>array(
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=wordstatgrabber',
            'emulatePrepare' => true,
            'username' => 'wordstat',
            'password' => '100lica',
            'charset' => 'utf8',
        ),

		/*'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
			),
		),*/
	),
);