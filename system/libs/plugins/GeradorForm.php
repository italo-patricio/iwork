<?php if(!defined('BASEPATH')) exit(header('Location: ./../index.php'));

/**
 * GeradorForm: Serve para criar formulários de maneira prática.
 *
 * @author italo
 */
class GeradorForm extends crud {
    
    private $atributos_form;
    private $campos;
    private $form;
    public function __construct($atributos_form = array()) {
        $this->setAtributos_form($atributos_form);
    }

    public function setAtributos_form ($atributos_form) {
        foreach ($atributos_form as $key => $value) {
            $this->atributos_form .= " {$key}='{$value}' "; 
            }
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
    public function addCampo($id=NULL,$class=NULL,$name,$tipo,$label=NULL,$placeholder=NULL,$value=NULL,$onClick=NULL,$endl=FALSE,$required=FALSE){
          $label = $label   != NULL  ? "\n<label for='{$name}'>{$label}</label>" : '';
    $placeholder = $placeholder != NULL ? "placeholder='".$placeholder."'" :'';
          $value = $value   != NULL  ? "value ='".$value."'" :'';
        $onClick = $onClick != NULL  ? "onClick ='".$onClick."'" : '' ; 
           $endl = $endl    != FALSE  ? "<br>":'';
       $required = $required != FALSE ? "required" :'';  
       $class    = $class   != NULL ? "class='".$class."'" :'';
       $id       = $id      != NULL ? "id='".$id."'" :'';    
       $this->campos .= "{$label}\n<input {$id}{$class} name='{$name}' type='{$tipo}' {$placeholder}{$value}{$required}{$onClick}/>\n{$endl}";
    }
    public function addSelect($name,$options =array(),$endl=FALSE){
        $endl   = $endl != FALSE ?"<br>":'';
        $select = "{$endl}<select name='{$name}'> ";
        foreach ($options as $key => $value) {
            $select .= "\n<option value='{$key}'>{$value}</option>\n";
        }
        $select .= "</select> {$endl}";
        $this->campos .= $select; 
    }
     public function searchType($type){
        if(strpos($type, 'varchar') > 0){
            $retorno_type = "text";
        }
        else if(strpos($type, 'int') > 0){
            $retorno_type = "number";
        }
        return  $retorno_type;
    }
    
    public function addCampoDinamic($tabela,$endl=FALSE){
        $_tb = new crud();
        $ret = $_tb->consultarNometb($tabela);
        foreach ($ret as $array) {
           if($array['Extra'] != "auto_increment"){
               $name = $array['Field'];
               $tipo = 'text';
               $label = $name;
               $this->addCampo(NULL,NULL,$name, $tipo, $label,NULL,NULL,NULL,$endl,FALSE);
           }
        }
        
        $label = $label   != NULL  ? "\n<label for='{$name}'>{$label}</label>" : '';
        
        $this->campos .= "{$label}\n<input name={$name} type={$tipo}  />\n";
       
    }
   private function createForm(){
      $this->form .=  $this->abrirForm();
      $this->form .=  $this->getCampos();
      $this->form .=  $this->fecharForm();
      return $this->form;
   }
    
   public function show(){
        print $this->createForm();
   }
}    
 
