<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));

/**
 * GeradorForm: Serve para criar formulários de maneira prática.
 *
 * @author italo
 */
class GeradorForm extends crud {
    
    private $atributos_form;
    private $campos;
    private $form;
    private $obj_dom;
    public function __construct($atributos_form = array()) {
        $this->setAtributos_form($atributos_form);
        $this->obj_dom = new DOMDocument();
        $this->obj_dom->formatOutput = TRUE;
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

    public function abrirForm(){
        return "<form {$this->getAtributos_form()}>";
    }
    public function fecharForm(){
        return "</form>";
    }
    /*
     * Site utilizado como referência para desenvolvimento: 
     * http://www.w3schools.com/html/html_forms.asp
     */
    public function input($name,$type, $options = array()){
        $opt = '';
        if(!empty($options)){
               foreach ($options as $key => $value) {
                   $opt .= $key.'="'.$value.'" '; 
               }
        }
       return "<input type=\"{$type}\" name=\"{$name}\"  {$opt} >";
    } 
    
    public function textarea($options = array(),$text=NULL){
       $textarea = $this->obj_dom->createElement('textarea', $text);
       if(!empty($options)){
            foreach ($options as $key => $value) {
                     $textarea->setAttribute($key, $value);
            }
       }
      return $this->obj_dom->saveHTML($textarea);
    }

    public function label($options = array(),$text=NULL){
       $label = $this->obj_dom->createElement('label', $text);
       if(!empty($options)){
            foreach ($options as $key => $value) {
                     $label->setAttribute($key, $value);
            }
       }
      return $this->obj_dom->saveHTML($label);
    }
    public function legend($text){
       $legend = $this->obj_dom->createElement('legend', $text);
       
      return $this->obj_dom->saveHTML($legend);
    }
    public function fieldset($legend=NULL,$content){
        $fieldset = '<fieldset>';
        $legend = $this->obj_dom->createElement('legend', $legend);
        $fieldset.= $this->obj_dom->saveHTML($legend).$content.'</fieldset>';
      return $fieldset; 
    }

    public function select(array $option) {
        $select = $this->obj_dom->createElement('select');
        
        foreach ($option as $key => $value) {
            $option = $this->obj_dom->createElement('option', $value);
            $option->setAttribute('value', $key);
            
            $select->appendChild($option);
        }
      return $this->obj_dom->saveHTML($select);  
    }
    /*
     * @example array(
     *                 0 => array('NameLabel'=>array('ValorKey'=>'ValorOption')),
     *                ) 
     */
    public function optgroup(array $list_optgroup) {
        $select = $this->obj_dom->createElement('select');
        foreach ($list_optgroup as $valueGroup) {
           
            $optgroup = $this->obj_dom->createElement('optgroup');
            foreach ($valueGroup as $label => $opts) {
            $optgroup->setAttribute('label', $label);
                            foreach ($opts as $optKey => $optVal) {
                                $option = $this->obj_dom->createElement('option', $optVal);
                                $option->setAttribute('value', $optKey);
                                $optgroup->appendChild($option);
                            }
            }
            $select->appendChild($optgroup); 
        }
      return $this->obj_dom->saveHTML($select); 
    }
    public function button($text,$options = array()) {
        $button = $this->obj_dom->createElement('button',$text);
        $button->setAttribute('type', 'button');
        if(!empty($options)){
            foreach ($options as $nameKey => $value) {
                $button->setAttribute($nameKey, $value);
            }
        }
       return $this->obj_dom->saveHTML($button); 
    }
    public function datalist($name,array $options){
        $input = "<input list=\"{$name}\" >";
        
        $datalist = "<datalist id=\"{$name}\">";
        $option = '';
        foreach ($options as $value) {
            $option .=  "<option value=\"{$value}\">";
        }
        $source = $input.$datalist.$option;
        return $source; 
        
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
 
