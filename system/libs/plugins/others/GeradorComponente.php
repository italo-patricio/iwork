<?php if(!defined('BASEPATH')) exit(header('Location: ./../../index.php'));

/**
 * GeradorComponente: Serve para criar componentes de maneira prática.
 *
 * @author italo
 */


/**
 * 
 * @example GeradorComponente.php como passar utilizar: informe um array com as
 * informações que cada atributo terá e o método se encarregará de criar o formulário
 * para a classe em questão informada bastando informar o array ou utilizando o showForm 
 * 
 * @example exemplo do formato do array
 * 
 *  array(
 *         array( NameElement , type, option ),
 *      
 *       )
 * 
 * 
 *  */

class GeradorComponente {
    
    /**
     * 
      @var tipo DOMDocument 
    */
    private $Dom_Obj;
    
    /**
     * 
      @var tipo DOMNODE
    */
    private $form;
    
    public function __construct() {
        try {
        
            $this->Dom_Obj = new DOMDocument();
            
        } catch (Exception $ex) {
            echo "Falha na construção erro: {$ex}";
        }
    }

    public function createForm($name,$action,$method,$return=FALSE) {
        $form =  $this->Dom_Obj->createElement('form');
        $form->setAttribute('name', $name);
        $form->setAttribute('action', $action);
        $form->setAttribute('method', $method);
      if(!$return)
          return $this->form = $form;
      else
          return $form;       
    }
    
    public function createInput($name,$return=FALSE) {
       $input = $this->Dom_Obj->createElement($name);
       if(!$return)
          return $this->form->appendChild($input);
      else
          return $input;       
    }

    public function createComponente($name,$value=NULL){
        $this->Dom_Obj->createElement($name, $value);
    } 
    
    public function setAtribut($name,$value=NULL,$target){
        if(is_string($target)){
            
        }
    }
    
    
}
