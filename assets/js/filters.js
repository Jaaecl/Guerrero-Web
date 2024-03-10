// Función que se ejecuta cuando se cambia el valor del select

function filtrar() {
	// Obtenemos el valor del select
	var filtro = document.getElementById("filtro").value;

	// Enviamos una petición AJAX al servidor para obtener los productos filtrados
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Actualizamos el contenido del div resultado con la respuesta del servidor
			document.getElementById("resultado").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "../controller/filterby.php?filtro=" + filtro, true);
	xhttp.send();
}

// Agregamos un event listener al select para que se ejecute la función filtrar cuando cambie su valor
document.getElementById("filtro").addEventListener("change", filtrar);