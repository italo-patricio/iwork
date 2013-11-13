<?php

// Configuração da aplicação

return array(
        'name'=>'Nome do projeto',
        'defaultController'=>'site',
        'defaultAction'=>'index',
        'import'=>array(
			APPMODELS
        ),
        'mysql' => array(
			'address'  => 'localhost',
			'driver'   => 'mysql',
			'port'     => 1212,
			'username' => 'root',
			'password' => '!@#',
			'dbname'   => 'nomedobanco'
        )
);
