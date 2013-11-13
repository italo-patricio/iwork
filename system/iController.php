<?php

class iController
{
    protected $model;
    protected $layout;
 
    function __construct($controller, $action, $model) {
         
        //$this->model = new $model; 
        //$this->_template = new Template($controller,$action);
 
    }
 
    function render($name,$params) {
        //$this->_template->set($name,$value);
    }
 
    function __destruct() {
          //  $this->_template->render();
    }
}
