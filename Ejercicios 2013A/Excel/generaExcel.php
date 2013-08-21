<?php 
$tabla = "<h1>Titulo de la tabla</h1>
		<table border=1>
		<tr>
		<td>a</td>
		<td>b</td>
		<td>c</td>
		<td>d</td>
		<td>e</td>
		</tr>
		<tr>
		<td>a</td>
		<td>b</td>
		<td>c</td>
		<td>d</td>
		<td>e</td>
		</tr>
		<tr>
		<td>aa</td>
		<td>bb</td>
		<td>cc</td>
		<td>dd</td>
		<td>ee</td>
		</tr>
		<tr>
		<td>ab</td>
		<td>cd</td>
		<td>ef</td>
		<td>gh</td>
		<td>jk</td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		</table>";

$filename ="contabla.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $tabla;

?>