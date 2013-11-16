<?php

// Configuração da aplicação
return array(
        'name' => 'Nome do projeto',
        'defaultController' => 'site',
        'defaultAction' => 'index',
		'url'=> ':',
        'mysql' => array(
			'address'  => 'localhost',
			'port'     => 0000,
			'username' => 'usuario',
			'password' => 'senha',
			'dbname'   => 'nomedobanco'
        ),
		'static'=>array( 
			'css'=>array(        // iUtils::registerCSS()
				'bootstrap.min',
				'bootstrap-theme.min'
			),
			'js'=>array(         // iUtils::registerJS()
				'jquery-1.10.2.min',
				'bootstrap.min'
			),		
		),
);
