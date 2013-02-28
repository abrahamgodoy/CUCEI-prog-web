 <?php
 /**
 * @package Ejercicios2013A
 * @license @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Michelle Torres <lic.nancy.torres@gmail.com>
 * @version 1.0
 */
 
 class Tablas{
 	public $inicio;
	public $fin;
	
	/**
	 * @param int $i Indica el inicio de la tabla
	 * @param int $f Indica el fin de la tabla
	 */
	function __construct($i,$f){
		$this->inicio = $i;
		$this->fin = $f;
	}
	
 	function imprimeTabla(){
 		for($tablas = 1 ; $tablas <= 12 ; $tablas++ ){
 			for($mul = $this->inicio ; $mul <= $this->fin ; $mul++ ){
 				echo $tablas , 'X' , $mul , '=' . $tablas*$mul . PHP_EOL;
 			}
			echo PHP_EOL;
 		}
 	}
 }
 
 
/* Obtener valores por GET para indicar el
 * inicio y fin de las tablas
 * i = inicio
 * f = fin
 * 
 * Validar los rangos de las tablas
 */ 

//Para debuggear utilizo print_r y muestro el valor de REQUEST
//que tiene dentro POST, GET y COOKIES	 
print_r($_REQUEST);


//Si no mandan valores, setear por default a 1 y 12
 if ( isset($_REQUEST['ini']) )
 	$inicio = $_REQUEST['ini'];
 else {
    $inicio = 1;
 }
 
 if ( isset($_REQUEST['fin']) )
 	$fin = $_REQUEST['fin'];
 else {
    $fin = 12;
 }
 
//Validar que se pueda realizar la tabla
 if($inicio > $fin)
 	echo 'no puedo hacer las tablas';
 else{
	$miTabla = new Tablas($inicio, $fin);
	$miTabla -> imprimeTabla();
 }
