<?php

/**
 * GeradorForm: Serve para criar formulários de maneira prática.
 *
 * @author italo
 */
class GeradorForm{
    
    private $atributos_form;
    private $campos;
    public function __construct($atributos_form = array()) {
        $this->setAtributos_form($atributos_form);
    }

    public function setAtributos_form ($atributos_form) {
        foreach ($atributos_form as $key => $value) {
                $retorno_atributos_mont .= " {$key}='{$value}' "; 
            }
        $this->atributos_form = $retorno_atributos_mont;
    }

    protected function getAtributos_form(){
        return $this->atributos_form ; 
    }
    protected function getCampos(){
        return $this->campos;
    }

    protected function abrirForm(){
        return "<form {$this->getAtributos_form()}>";
    }
    protected function fecharForm(){
        return "</form>";
    }
    
    /*
     * @var string
     * tipos de input:
     * http://www.w3schools.com/tags/att_input_type.asp
     */
    public function addCampo($name,$tipo,$label=NULL,$value=NULL,$onClick=NULL){
          $label = $label   != NULL  ? "\n<label for='{$name}'>{$label}</label>" : '';
          $value = $value   != NULL  ? "value =".$value:'';
        $onClick = $onClick != NULL  ? "onClick=".$onClick : '' ; 
        
        $this->campos .= "{$label}\n<input name={$name} type={$tipo} {$value} {$onClick} />\n";
    }
    

      public function show(){
      $form .=  $this->abrirForm();
      $form .=  $this->getCampos();
      $form .=  $this->fecharForm();
      return print $form;
    }
}    
 

