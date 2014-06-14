<?php


/**
 * Description of testeControl
 *
 * @author Ítalo
 */
class testeControl extends controller 
{
    public function __construct() {
        parent::__construct();
        
        $this->base = 'base';
    }

    public function test(){
        //$usuario = $_SESSION['session']['logado'][0];
  //echo 'Nome do cara: '.$usuario['nome'];
 //addCampo($name,$tipo,$label=NULL,$placeholder=NULL,$value=NULL,$onClick=NULL,$endl=FALSE,$required=FALSE,$pattern=NULL)
        $form = new GeradorForm(array('id'=>'form','method'=>'post'));
        #$form->setAtributos_form();
        $form->addCampo(NULL,'maskDate','data','text','Data: ','dia/mes/ano',NULL,NULL,TRUE);
        $form->addSelect('cor',['1'=>'Azul','2'=>'Amarelo','3'=>'Branco']);
        $form->addCampo(NULL,NULL,'bt','submit',NULL,'Validar');
        $form->show();
    }
    public function index($param) {
        $gF = new GeradorForm();
        
       $list_optgroup = array(
            array('NameLabel'=>array('ValorKey'=>'ValorOption','ValorKey2'=>'ValorOption2')),
            array('NameLabel2'=>array('ValorKey2'=>'ValorOption2')),
        )
        ;
       echo $gF->datalist('QueroVer',array('teste2','teste2'));
        
    }
    
    public function conect(){
       
        
        /*
       $login = new Login();
       $login->user = 'novo';
       $login->password= '1a2s23';
       $login->save(); 
        */
       $usuario = new Usuario();
       $usuario->nome    = 'servulo fonseca';
       $usuario->idade   = 22;
       $usuario->idlogin = 3;
       if($usuario->save())
        echo 'Salvo com sucesso!';
       else
           print_r ($usuario->errors);       

        


        #$login = new Login(array(MOD=>$this->connection[MOD]));
        #$login->user = 'italo';
        #$login->password = '123';
       #if($login->save(true)){
       #    echo 'Salvo com sucesso!';
       #}
       #else
       #    print_r ($login->errors);
        
    }
    public function login(){
               //titulo da pagina
        $this->atr_page['titulo'] = 'Login ';	
        //classe do controle 
        $this->atr_page['control'] = 'menu/';
        
        $this->res[] = $this->atr_page;
        
        $this->view('login', $this->res);
    }
    public function metodo(){
            echo '<pre>';
            print_r($_POST);
        try{ 
        $login = new Login($_POST);
        $login->save(true);
           echo 'Salvo com sucesso!';
        }
        catch (ActiveRecord\ActiveRecordException $ex){
            echo 'Falha ao salvar!';
        }
    }
    
    public function find(){
        
        try{
         $loging = Login::find(4);

         echo $loging->user;
        }  catch (ActiveRecord\ActiveRecordException $ex){
             echo 'Usuario nao encontrado!';
        }
    }
    public function base(){
        $this->base = 'base2';
        $this->res[] = $this->atr_page;
        
        $this->view('inicio', $this->res);
    }
    
    public function select(){
       $ret = crud::consultarNomeColuna('logins');
       
       echo '<pre>';
      # print_r($ret);
        foreach ($ret as $value) {
            if(stristr($value['Key'],'pri'))
                echo  $value['Field'];
     
         }
         $key ='logins';
             if( !file_exists(BASEAPLICATION.'model'))
                  if(!mkdir(BASEAPLICATION.'model/'))  
                      throw new Exception;
             if( !file_exists(BASEVIEWINC.$key))
                  if(!mkdir(BASEVIEWINC.$key.'/'))  
                      throw new Exception;
    }
    
    public function compar(){
       if(stristr('INT(11)', 'inte')){
           echo 'TRUE';
       }
       else echo 'False';
    }
    public function syncdb(){
        core::syncdbAR();
    }
}
