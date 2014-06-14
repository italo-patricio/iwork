<?php

class ConfigAR extends configDB{}


ActiveRecord\Config::initialize(function($cfg)
{
    try{  
          $config = new ConfigAR();

           $cfg->set_model_directory(BASEMODEL);
           $cfg->set_connections(array('development'=>
           "{$config->db_driver}://{$config->db_user}:"
           . "{$config->db_senha}@{$config->db_host}:{$config->db_port}/{$config->db_name}"));
     }
     catch (ActiveRecord\ActiveRecordException $ex){
       echo 'Falha na comunição com o banco!';
     }   
 });

