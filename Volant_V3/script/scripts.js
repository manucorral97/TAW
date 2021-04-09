/*Solo nos dejará seleccioanr fechas posteriores al momento actual*/
function minDay() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; //Enero es el 0!
	var yyyy = today.getFullYear();
	if (dd < 10) {
		dd = '0' + dd
	}
	if (mm < 10) {
		mm = '0' + mm
	}

	today = yyyy + '-' + mm + '-' + dd;
	document.getElementById("Salida").setAttribute("min", today);
	document.getElementById("envioBilletes").setAttribute("min", today);
}

/*A traves de JS comprobamos que el formulario es valido. Si no, no dejamos continuar*/
function validar(origen, destino) {
	var todo_correcto = true;
	/*Comprobar que origen y destino no son iguales*/
	if (document.getElementById("Origen").value == document.getElementById("Destino").value) {
		alert('Por favor, introduce un origen o un destino diferente');
		todo_correcto = false;
	}

	/*Comprobar campos corretcos y actualizo el fondo de las cajas para resaltar los fallos*/
	if (document.getElementById("Origen").value.length < 2) {
		document.getElementById("Origen").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}
	if (document.getElementById("Destino").value.length < 2) {
		document.getElementById("Destino").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}
	if (document.getElementById("Salida").value.length < 2) {
		document.getElementById("Salida").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}
	if (document.getElementById("Viajeros").value.length < 1) {
		document.getElementById("Viajeros").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}

	if (!todo_correcto) {
		alert("Rellene todos los campos por favor");
	}
	/*Si los datos del formulario son correctos, llamamos al server para leer el XML*/
	if (todo_correcto) {
		/*Volvemos al estilo original*/
		document.getElementById("Origen").style.background = null;
		document.getElementById("Destino").style.background = null;
		document.getElementById("Ida").style.background = null;
		document.getElementById("Vuelta").style.background = null;
		document.getElementById("Viajeros").style.background = null;
		loadXML(origen, destino);
	}

	return todo_correcto;
}

/*Cargamos el docuento XML alojado en nuestro servidor*/
function loadXML(origen, destino) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		/*Peticion lista y OK*/
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			mostrarInfo(xmlhttp, origen, destino);
		}
	};
	/*Recogemos el documento XML*/
	xmlhttp.open("GET", "infoVuelos.xml", true);
	/*Mandamos el documento XML*/
	xmlhttp.send();
}

/*Mostramos la informacion relevante (Aquí tendria que inicializar la tabla)*/
function mostrarInfo(xml, origen, destino) {
	var i;
	var j = 0;
	var xmlDoc = xml.responseXML;
	/*Recorremos el fichero por cada vuelo*/
	var vuelos = xmlDoc.getElementsByTagName("vuelo");

	/*Cabecera de la tabla*/
	var table = "<caption>¡Estas son tus opciones!</caption>"
	table += "<tr><th>ORIGEN</th><th>DESTINO</th><th>SALIDA</th><th>LLEGADA</th><th>PRECIO</th></tr>";

	/*Voy ajustando la tabla a la busqueda*/
	for (i = 0; i < vuelos.length; i++) {
		if(vuelos[i].getElementsByTagName("origen")[0].textContent == origen && vuelos[i].getElementsByTagName("destino")[0].textContent == destino){
			table += "<tr><td>"
			table += vuelos[i].getElementsByTagName("origen")[0].textContent;
			table += "</td><td>"
			table += vuelos[i].getElementsByTagName("destino")[0].textContent;
			table += "</td><td>"
			table += vuelos[i].getElementsByTagName("salida")[0].textContent;
			table += "</td><td>"
			table += vuelos[i].getElementsByTagName("llegada")[0].textContent;
			table += "</td><td>"
			table += vuelos[i].getElementsByTagName("precio")[0].textContent;
			table += "</td><td>"
			table += "<button>Volar</button>"
			table += "</td></tr>"
		}

	}
	document.getElementById("resultados").innerHTML = table;
}

/*Cuando el cliente pulsa limpiar se borra la tabla de la vista del usuario*/
function resetTabla(){
	var table = ""
	document.getElementById("resultados").innerHTML = table;
}

/*-------------CONTACT-page----------------*/
/*Valido los campos del formulario para el correo*/
function validarCorreo() {
	var todo_correcto = true;
	if (document.getElementById("emailUser").value == "") {
		alert("Debes indicar tu email");
		document.getElementById("emailUser").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}

	if(document.getElementById("texto").value == ""){
		alert("Incluye un mensaje");
		document.getElementById("texto").style.background = "linear-gradient(to right, pink, rgb(255, 255, 255))";
		todo_correcto = false;
	}

	if(todo_correcto){
		alert('¡Gracias por tu mensaje!');
	}
	return todo_correcto;
}
