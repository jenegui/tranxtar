//DMDIAZF - Agosto 15, 2012
//Funciones JavaScript para el modulo 1 de fuente
//

$(function(){
	var mensajeIDPRORAZ = "Justifique el cambio de razon social.";
	//Configuracion inicial del formulario
	$("#tabs").tabs();
	$("#idproraz").mayusculas().largo(60);
	$("#idnomcom").mayusculas().largo(60);	
	$("#idsigla").mayusculas().largo(20);	
	$("#iddirecc").mayusculas().largo(40);	
	$("#iddepto").cargarCombo("idmpio","fuente/actualizarmunicipios");  
	$("#idtelno").numerico().largo(13);	
	$("#idfaxno").numerico().largo(13);
	$("#idpagweb").minusculas().largo(255);
	$("#idcorreo").minusculas().largo(80);	
	$("#finicial").datepicker();
	$("#ffinal").datepicker();
	//$("#ffinal").hint("Referente al periodo que se ofreci&oacute; el servicio de alojamiento - Fecha de operaci&oacute;n.");
	$("#idnomcomest").mayusculas().largo(60);
	$("#idsiglaest").mayusculas().largo(20);
	$("#iddireccest").mayusculas().largo(40);
	$("#iddeptoest").cargarCombo("idmpioest","fuente/actualizarmunicipios");
	$("#idtelnoest").numerico().largo(13);	
	$("#idfaxnoest").numerico().largo(13);
	$("#idcorreoest").minusculas().largo(80);
        
        $("#idproraz").cajaObservaciones2('$("#idproraz").val() != "" ','dividproraz',mensajeIDPRORAZ,'obsidproraz');
	
        //Lanzo función ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en los recuadros.
	$.ajax({
		type: "POST", 
		url: base_url + "fuente/obtenerObservaciones",
		data: {'campo': 0, 'modulo': 1}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 3
		dataType: "html", 
	    cache: false,
		success: function(data){
			
			var datos = eval(data);
			if(typeof(datos) != "undefined"){ //Si se recibio alguna respuesta de observaciones 
				for (i=0; i<datos.length; i++){
					var bloquear = "";
					var div = "#div"+ datos[i].campo;
					var caja = "obs" + datos[i].campo;
					datos[i].mensaje = obtenerMensaje1(datos[i].campo); //Obtengo el mensaje para la justificacion.
					if (datos[i].bloqueo==true){
						var bloquear = 'disabled = "disabled"';
					}					
					var contenido = '<p>'+datos[i].mensaje+'</p><textarea id="'+caja+'" name="'+caja+'" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"'+ bloquear +'>'+datos[i].descripcion+'</textarea>';
					$(div).html(contenido);
				}
			}																
		}					
	});
        
	//Validar el formulario del modulo I (Caratula)
	//$("#btnModuloI").click(function(){
		$("#frmModuloI").validate({
			rules : {
				idproraz : {	required   :  true,
                                                alfanumerico : true	
				},
				idnomcom : {	required   :  true
				},
				idsigla  : {	maxlength  :  20 
				},
				iddirecc : {	required   :  true	
				},
				iddepto  : {	comboBox   :  '-'
				},
				idmpio   : {	comboBox   :  '-'
				},
				idtelno  : {	required   :  true,
				                min        :  7
				},
				idpagweb : {    required   : false,
								url        : true
				},
				idcorreo : {	email      :  true
				},
				finicial : {	required   :  true									
				},
				ffinal   : {	required   :  true															
				},
				idnomcomest: {  required   :  true,
								alfanumerico : true
				},
				idsiglaest: {   maxlength  :  20
				},
				iddireccest : {	required   :  true	
				},
				iddeptoest  : {	comboBox   :  '-'						
				},
				idmpioest   : {	comboBox   :  '-'
				},
				idtelnoest  : {	required   :  true,
                                min        :  7
				},
				idcorreoest : {	email      :  true
				},
                                obsidproraz : { required    :   true
                                }    
			},
			messages : {
				idproraz : {	required   :  "Falta la raz&oacute;n social.",
					            alfanumerico:  "El campo debe ser alfanumerico."
				},
				idnomcom : {    required   :  "Falta nombre comercial."					
				},
				idsigla  : {	maxlength  :  "M&aacute;ximo 20 caracteres."
				},
				iddirecc : {	required   :  "Falta la direcci&oacute;n de la gerencia."					
				},
				iddepto  : {	comboBox   :  "Falta el nombre del departamento."						
				},
				idmpio   : {	comboBox   :  "Falta el nombre del municipio."
				},
				idtelno  : {	required   :  "Falta n&uacute;mero de tel&eacute;fono.",
					            min        :  "M&iacute;nimo 7 D&iacute;gitos."
				},
				idpagweb : {    required   : "",
						url        : "Digite una direcci&oacute;n v&aacute;lida (http://www.xxxxx.com)."
				},
				idcorreo : {	email      : "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."					
				},
				finicial : {	required   : "Falta fecha inicial."										
				},
				ffinal   : {	required   : "Falta fecha final."
				},
				idnomcomest: {  required   : "Falta nombre comercial establecimiento.",
					            alfanumerico:  "El campo debe ser alfanumerico."          
				}, 
				idsiglaest: {   maxlength  : "M&aacute;ximo 20 caracteres."
				},
				iddireccest : {	required   : "Falta la direcci&oacute;n del establecimiento."
				},
				iddeptoest  : {	comboBox   : "Falta el nombre del departamento."						
				},
				idmpioest   : {	comboBox   : "Falta el nombre del municipio."
				},
				idtelnoest  : {	required   : "Falta n&uacute;mero de tel&eacute;fono.",	
		                         min       : "M&iacute;nimo 7 D&iacute;gitos."
				},
				idcorreoest : {	email      : "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."
				},
                                obsidproraz : { required : "Por favor justifique."
                                }    
			},
			errorPlacement: function(error, element) {
				//Mostrar el error en la parte de abajo de la caja de texto.
				element.after(error);
                                error.css('opacity','0.47');
                                error.css('z-index','991');
                                error.css('background','#ee0101');
                                //error.css('float','right');
                                error.css('position','absolute');
                                error.css('margin-top','1px');
                                error.css('color','#fff');
                                error.css('font-size','11px');
                                error.css('border','2px solid #ddd');
                                error.css('box-shadow','0 0 6px #000');
                                error.css('-moz-box-shadow','0 0 6px #000');
                                error.css('-webkit-box-shadow','0 0 6px #000');
                                error.css('padding','4px 10px 4px 10px');
                                error.css('border-radius','6px');
                                error.css('-moz-border-radius','6px');
                                error.css('-webkit-border-radius','6px');
			},
			submitHandler: function(form) {
				//Valido las fechas antes de hacer el submit de la caratula
				var finicial = $("#finicial").val();
				var ffinal = $("#ffinal").val();
				var ini = parseDate(finicial);			
				var fin = parseDate(ffinal);
				if (ini > fin){
					$("#divError").html("La fecha inicial debe ser anterior a la fecha final.");
					return false;
				}
				else{
					//Luego de validadas las fechas hago el submit del formulario
					$("#divError").html("");
					$.ajax({
						type: "POST",
						url: base_url + "fuente/actualizarModuloI",
						data: $("#frmModuloI").serialize(),
						dataType: "html",
						cache: false,
						success: function(data){
							
							//alert(data);
							var image = $("#imgtab1");
					   		image.attr("src", base_url + "/images/tick.png");						    
					   		$("#tabs").tabs({selected: 1});					   							   							   								   								   		
						}
					});
				}								
			}
		});		
	//});
	
	
	
});

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje1(campo){
	var mensaje = "";
        switch(campo){
            case 'idproraz':  mensaje = "Justifique el cambio de razon social.";
	break;
	}
	return mensaje; 
	
}