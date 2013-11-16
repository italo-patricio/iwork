<?php

class iView
{
	public static function render($controller, $action, $params, $layout)
	{
		if(file_exists(APPVIEWS.$controller.'/'.$action.'.php'))
		{
			if (file_exists(APPVIEWS.$layout.'.php'))
			{
				ob_start();
					require_once(APPVIEWS.$controller.'/'.$action.'.php');
					$content = ob_get_contents();
				ob_end_clean();
				
				require_once(APPVIEWS.$layout.'.php');

				exit();
			}
			else 
			{
				// dev message
				echo utf8_decode('<h2>A layout especificado "'.$layout.'.php" não existe!</h2>');				
			}
		}
		else
		{
			// dev message
			echo utf8_decode('<h2>A view especificada "'.$controller.'/'.$action.'.php" não existe!</h2>');
		}
	}
}
