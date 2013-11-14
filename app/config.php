<?php

// Configuração da aplicação
return array(
        'name' => 'Nome do projeto',
        'defaultController' => 'site',
        'defaultAction' => 'index',
        'import' => array(
			'application.models',
			'system.widgets',
        ),
        'mysql' => array(
			'address'  => 'localhost',
			'port'     => 0000,
			'username' => 'usuario',
			'password' => 'senha',
			'dbname'   => 'nomedobanco'
        )
);
