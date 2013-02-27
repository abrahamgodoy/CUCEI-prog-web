 <?php
 
 class Tablas{
 	public $inicio;
	public $fin;
	
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
print_r($_REQUEST);
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
 
 if($inicio > $fin)
 	echo 'no puedo hacer las tablas';
 else{
	$miTabla = new Tablas($inicio, $fin);
	$miTabla -> imprimeTabla();
 }
