/** Esta función muestra como se puede crear variables usando el patron single var,
cuando dependen de un objeto con una referencia a otro.*/
function updateElement(){
	var el = document.getElementById("result"),
		style = el.style;
	// do something with el and style...
}

$(document).ready(function(){
	//single var statement at the top of your functions
	var buenas_practicas = 1,//Buen patrón
		malas_practicas;//Undefined		
	return;
});



