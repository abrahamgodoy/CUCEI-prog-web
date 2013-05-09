<?php

	class ArchivoServidor{
		private $directorio;
		private $archivo;
		private $extension;
		private $tamano;
		private $nomTemp;
		
		function subir($nombre, $directorio, $archivo, $extensiones, $tamanoMaximo){
			$error = $archivo['error'];
			$size = $archivo['size'];
			$extensionValida = FALSE;
			if($error > 0){
				return $error;
			}
			
			if($size > $tamanoMaximo){
				return 'error-tamano';
			}
			
			foreach ($extensiones as $extension){
				if($archivo['type'] == $extension){
					$extensionValida = TRUE;
					break;
				}
			}
			
			if(!$extensionValida){
				return 'error-tipo';
			}
			
			return move_uploaded_file($archivo['tmp_name'], $directorio.$nombre);
		}
		
		function eliminar($directorio){
			return unlink($directorio);
		}
		
	}
?>