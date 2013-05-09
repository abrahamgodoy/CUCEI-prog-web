<?php
//controlador requiere tener acceso al modelo
include_once('model/UsuarioBSS.php');
include_once('ModeloCtl.php');
	class LogCtl extends ModeloCtl{
		public $modelo;
		//cuando se crea el contrador crea el modelo usuario
		function __construct(){
			$this->modelo = new UsuarioBSS();
		}

		function ejecutar(){
		//cargando sesion
			$hacer=$_REQUEST['hacer'];
			session_start();
			
			switch ($hacer){
				case 'in':
					//No esta loggeado entonces si le voy a permitir hacer login
					if(!isset($_SESSION['usuario'])){
						//si no tengo parametros se listan los usuarios
							if (!isset($_REQUEST['usuario']) && !isset($_REQUEST['pass']))
								//Incluir el formulario
								include('view/loginForm.html');
							else{
								$id=$_REQUEST['usuario'];
								$pass=$_REQUEST['pass'];
								$usuario=$this->modelo->login($id,$pass);
							
								if(is_object($usuario)){
								//si existe
									$_SESSION['usuario']=$usuario->id;
									$_SESSION['nombre']=$usuario->nombre;
									$_SESSION['privilegio']=$usuario->tipo;				
							
									include('view/LogInView.php');
								}else
								{
									include('view/LogErrorView.php');
								}
							}
					}else
						include('view/View.php');
					break;
				case 'out':
					//Definir los datos de la vista
					$datos = array(
						'{titulo-pagina}' => 'Algo',
						'{autor}'	=> 'Michelle Torres',
					);
					echo $this->procesaPlantilla('view/index.html', $datos);
					
					if(!isset($_SESSION['usuario'])){
					//limpiar session
					session_unset();
					//destruye sesion
					session_destroy();
					setcookie(session_name(),'',time()-1);
					var_dump ($_SESSION);
					}
					include('view/View.php');
					break;
				
			}
		}
		
		function procesaPlantilla($ruta,$diccionario){
			//Obtener el contenido de la plantilla
			$plantilla = file_get_contents($ruta);
			
			//Reemplazar las variables de la plantilla por los datos del diccionario
			$plantilla = str_replace(array_keys($diccionario), $diccionario, $plantilla); 
			
			//Regresar el contenido de la plantilla
			return $plantilla;
		}
	}



?>