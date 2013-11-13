<?php

class iView
{
	public static function render($controller, $action, $params)
	{
		if(file_exists(APPVIEWS.$controller.DS.$action.'.php'))
		{
			ob_start();
				require_once(APPVIEWS.$controller.DS.$action.'.php');
				$content = ob_get_contents();
			ob_end_clean();
			
			require_once(APPVIEWS.'layout.php');

			exit();
		}
		else 
		{
			// dev message
			echo utf8_decode('<h2>A view especificada "'.$this->_controller.DS.$this->_action.'.php" não existe!</h2>');
		}
	}
	
}
