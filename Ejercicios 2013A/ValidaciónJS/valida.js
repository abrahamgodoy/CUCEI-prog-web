function validaform(){
	var form = document.getElementById('cliente');
	
	/* Validacion del CP */

	//Obtengo el input
	var input_CP = document.getElementById('cp');

	//Valido el input
	if ( ! /^\d{5}$/.test(input_CP.value) ){
		//Creo el elemento con la clase error
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','cp_error');
		
		//Creo el texto
		var msg = document.createTextNode('El CP no cumple con el formato');

		//Al div le agrego el mensaje
		div.appendChild(msg);
		
		//Insertar el mensaje en el dom
		form.insertBefore(div,input_CP.nextSibling);
	}
	else{
		var div_error = document.getElementById('cp_error');
		if ( typeof(div_error) == 'object' )
			form.removeChild(div_error);
	}
	if ( document.cliente.estado.selectedIndex == 0 )
		alert('Debe seleccionar un estado');
}