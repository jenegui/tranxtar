//DMDIAZF - Agosto 15, 2012
//Funciones JavaScript para el modulo III de fuente
//

$(function(){
	
	//Configuracion inicial del formulario
	var mensajeINALO = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
	//var mensajeINALI = "Justificar por qu&eacute; los ingresos por servicio de restaurante y catering para eventos son mayores que los de servicios de alojamiento.";
	var mensajeINTIO = "Discrimine los otros ingresos operacionales.";
	var mensajeINTIO3 = "Justifique el porque sus ingresos diferentes a alojamiento son  mayores a los de alojamiento.";	
	//var mensajeINOIO = "Desagregue y justifique valor de otros ingresos operacionales.";
	var mensajeINALO2 = "Especifique el valor de ingresos por alojamiento.";
	var mensajeINALO3 = "Justifique por qu&eacute; los ingresos por alojamiento est&aacute;n en cero.";
	var mensajeINBA = "Justificar por qu&eacute; los ingresos por bebidas alcoh&oacute;licas son mayores que los de servicio de alojamiento.";
	var mensajeINSR = "Justificar por qu&eacute; los ingresos por servicios receptivos y conexos son mayores que los ingresos por alojamiento.";
	var mensajeINOE = "Justificar por qu&eacute; los ingresos por organizaci&oacute;n de eventos  son mayores que los ingresos por alojamiento, y especifique los principales eventos realizados.";
	//var mensajeINOIO = "Discrimine los otros ingresos operacionales.";
	//var mensajeINCAT = "Especifique el ingreso por rervicios de catering para eventos.";
	
	$("#inalo").numerico().largo(9); 
	$("#inalovd").numerico().largo(9);
	$("#inaloatc").numerico().largo(9);
	$("#inali").numerico().largo(9);
	$("#inba").numerico().largo(9);
	$("#insr").numerico().largo(9);
        $("#inoeconv").numerico().largo(7);
        $("#inoeeven").numerico().largo(7);
	$("#inoe").numerico().largo(9);
	//$("#incat").numerico().largo(9);
	$("#inoio").numerico().largo(9);
	$("#intio").numerico().largo(9);
	$("#inalii").hint("Catering (Producci&oacute;n de servicio de comida en el lugar se&ntilde;alado por el cliente).");	
	$("#inoee").hint("MICE (Meeting, incentives, congresses, exhibitions). Incluya todo lo referente a alquiler; log&iacute;stica, alimentaci&oacute;n, promoci&oacute;n y venta  de eventos empresariales o sociales.");
	$("#inoioo").hint("Incluya todo lo referente a comunicaciones, lavander&iacute;a, peluquer&iacute;a, arrendamientos,  etc.");
	$("#insrr").hint("City tours, gu&iacute;as tur&iacute;sticos, pasad&iacute;as, organizaci&oacute;n de viajes, operadores, servicios similares y conexos.");
	$("#incatt").hint("Producci&oacute;n de servicio de comida en el lugar se&ntilde;alado por el cliente.");
	$("#intio").cajaObservaciones('parseInt($("#inalo").val()) < 0.5 * parseInt($("#intio").val())','divintio1',mensajeINALO,'obsintio1');
	$("#intio").cajaObservaciones('parseInt($("#inoio").val()) > 0.1 * parseInt($("#intio").val())','divintio2',mensajeINTIO,'obsintio2');
	$("#intio").cajaObservaciones('(parseInt($("#inali").val())+parseInt($("#inba").val())+parseInt($("#insr").val())+parseInt($("#inoe").val())+parseInt($("#inoio").val())) > parseInt($("#inalo").val())','divintio3',mensajeINTIO3,'obsintio3');
	$("#inalo").cajaObservaciones('parseInt($("#inalo").val()) > 0','divinalo',mensajeINALO2,'obsinalo');
	$("#intio").cajaObservaciones1('parseInt($("#inalo").val()) == 0','divinalo3',mensajeINALO3,'obsinalo3');
	//$("#inali").cajaObservaciones('parseInt($("#inali").val()) > parseInt($("#inalo").val())','divinali',mensajeINALI,'obsinali');
	//$("#inoio").cajaObservaciones('parseInt($("#inoio").val()) > 0','divinoio',mensajeINOIO,'obsinoio');
	//$("#inoe").cajaObservaciones('parseInt($("#inoe").val()) > 0','divinoe',mensajeINOE,'obsinoe');
	//$("#inba").cajaObservaciones('parseInt($("#inba").val()) > parseInt($("#inalo").val())','divinba',mensajeINBA,'obsinba');
	//$("#insr").cajaObservaciones('parseInt($("#insr").val()) > parseInt($("#inalo").val())','divinsr',mensajeINSR,'obsinsr');
	$("#inoe").cajaObservaciones('parseInt($("#inoe").val()) > parseInt($("#inalo").val())','divinoe',mensajeINOE,'obsinoe');
	//$("#inoio").cajaObservaciones('parseInt($("#inoio").val()) > 0.1 * parseInt($("#intio").val())','divinoio',mensajeINOIO,'obsinoio');
	//$("#incat").cajaObservaciones('parseInt($("#incat").val()) > 0','divincat',mensajeINCAT,'obsincat');
	
	//Lanzo función ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en los recuadros.
	$.ajax({
		type: "POST", 
		url: base_url + "fuente/obtenerObservaciones",
		data: {'campo': 0, 'modulo': 3}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 3
		dataType: "html", 
	    cache: false,
		success: function(data){
			
			var datos = eval(data);
			if(typeof(datos) != "undefined"){ //Si se recibio alguna respuesta de observaciones 
				for (i=0; i<datos.length; i++){
					var bloquear = "";
					var div = "#div"+ datos[i].campo;
					var caja = "obs" + datos[i].campo;
					datos[i].mensaje = obtenerMensaje3(datos[i].campo); //Obtengo el mensaje para la justificacion.
					if (datos[i].bloqueo==true){
						var bloquear = 'disabled = "disabled"';
					}					
					var contenido = '<p>'+datos[i].mensaje+'</p><textarea id="'+caja+'" name="'+caja+'" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"'+ bloquear +'>'+datos[i].descripcion+'</textarea>';
					$(div).html(contenido);
				}
			}																
		}					
	});
	
	//Validar el formulario del Modulo 3 (Ingresos Netos operacionales causados en el mes)
	$("#frmModuloIII").validate({
		rules : {
			inalo    : {	required   		:   true,
                                        menorQue		:   0
                                        //igualQue       :  'parseInt($("#inalovd").val()) + parseInt($("#inaloatc").val())'
			},
			inalovd    : {	required   		:   true, 
                                        menorQue		:   0
			}, 
			inaloatc    : {	required   		:   true,
                                        menorQue		:   0
			},
			inali    : {	required        :   true,
                                        menorQue   		:   0
                                        //expresion  	    :   'parseInt($("#inali").val())>parseInt($("#inalo").val())' 
			},
			inba     : {	required        :   true,
							menorQue        :   0
			},
			insr     : {	required        :   true,
							menorQue        :   0
			},
			inoe     : {	required        :   true,
                                        menorQue        :   0,
                                        igualQue       :  'parseInt($("#inoeconv").val()) + parseInt($("#inoeeven").val())'
			},
                        inoeconv    : {	required   	:   true, 
					menorQue	:   0
			}, 
			inoeeven    : {	required	:   true,
					menorQue	:   0
			},
			incat     : {	required        :   true,
                                        menorQue        :   0,
                                        expresion       :  'parseInt($("#incat").val())>parseInt($("#inalo").val())'
			},
			inoio    : {	required        :   true,
                                        menorQue        :   0			
			},
			intio    : {	required        :   true,
                                        //diferenteDe	    :   0,
                                        menorQue        :   0,
                                        igualQue        :   'parseInt($("#inalo").val()) + parseInt($("#inali").val()) + parseInt($("#inba").val()) + parseInt($("#insr").val()) + parseInt($("#inoe").val()) + parseInt($("#inoio").val())'  //La suma no corresponde
			},
			obsintio1 : {	required   		:   true
			},
			obsintio2: {    required		: 	true
			},
			obsinalo: {		required		: 	true
			},
			obsinali: {		required		: 	true
			},
			obsinoe: {		required		: 	true
			},
			obsincat: {		required		: 	true
			},
			obsinoio: {		required		: 	true
			},
			obsinba: {		required		: 	true
			},
			obsinsr: {		required		: 	true
			},
			obsinoe: {		required		: 	true
			},
			obsinoio: {		required		: 	true
			},
			obsintio3: {	required		: 	true
			},
                        obsinalo3:  {   required      :    true
                        },    
		},
		messages : {
			inalo    : {	required   	:   "Falta ingresos por alojamiento.",
                                        menorQue	:   "No pueden haber ingresos negativos."
                                        //igualQue        :   "La suma no corresponde."
			},
			inalovd    : {	required	:   "Falta  Ingresos por  alojamiento por ventas directas.",
                                        menorQue        :   "No pueden haber ingresos negativos."
			},
			inaloatc    : {	required	:   "Falta Ingresos por alojamiento  por administracion de tiempo compartido.",
                                        menorQue	:   "No pueden haber ingresos negativos."
			},
			inali    : {	required        :   "Falta ingresos por servicios de restaurante y catering para eventos.",
                                        menorQue        :   "No pueden haber ingresos negativos."
                                        //expresion		:   "Los ingresos por servicio de Restaurante  y catering para eventos son mayores que los de servicio de alojamiento."
			},
			inba     : {	required        :   "Falta ingresos por bebidas alcoh&oacute;licas y cigarrillos.",
                                        menorQue        :   "No pueden haber ingresos negativos."
			},
			insr     : {	required        :   "Falta ingresos de Servicios Receptivos.",
                                        menorQue        :   "No pueden haber ingresos negativos."
			},	
			inoe     : {	required        :   "Falta ingresos por alquiler de salones y/o eventos.",
                                        menorQue        :   "No pueden haber ingresos negativos.",
                                        igualQue        :   "La suma no corresponde."
			},
                        inoeconv    : {	required   	:   "Falta ingresos por  convenciones .",
					menorQue        :   "No pueden haber ingresos negativos."
			},
			inoeeven    : {	required   	:   "Falta ingresos por  eventos sociales.",
			 		menorQue	:   "No pueden haber ingresos negativos."
			},
			incat     : {	required        :   "Falta servicios de catering para eventos.",
							menorQue        :   "No pueden haber ingresos negativos.",
							expresion       :   "Los ingresos por Servicios de Servicios de catering para eventos son mayores que los ingresos por alojamiento."
			},
			inoio    : {	required        :   "Faltan otros ingresos netos operacionales.",
							menorQue        :   "No pueden haber ingresos negativos."
			},
			intio    : {	required        :   "Falta total de ingresos operacionales.",
							//diferenteDe     :   "Falta total de ingresos operacionales.",
							menorQue        :   "No pueden haber ingresos negativos.",
							igualQue        :   "La suma no corresponde."
			},
			obsintio1 : {	required   		:   "Justifique."
			},
			obsintio2: {    required		: 	"Justifique."
			},
			obsinalo: {		required		: 	"Justifique."
			},
			obsinali: {		required		: 	"Justifique."
			},
			obsinoe: {		required		: 	"Justifique."
			},
			obsincat: {		required		: 	"Justifique."
			},
			obsinoio: {		required		: 	"Justifique."
			},
			obsinba: {		required		: 	"Justifique."
			},
			obsinsr: {		required		: 	"Justifique."
			},
			obsinoe: {		required		: 	"Justifique."
			},
			obsinoio: {		required		: 	"Justifique."
			},
			obsintio3: {		required		: 	"Justifique."
			},
                        obsinalo3: {            required                :       "Justifique."
                        },    
		},
		errorPlacement: function(error, element) {
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
			$.ajax({
				//async: false,
				type: "POST",
				url: base_url + "fuente/actualizarModuloIII",
				data: $("#frmModuloIII").serialize(),
				dataType: "html", 
				cache: false,
				success: function(data){
					var image = $("#imgtab3");
					image.attr("src", base_url + "/images/tick.png");
					$("#tabs").tabs({selected: 3});										
				}
			});
		}
	});
	
    $(document).ready(function(){
    	$('.sumaring').blur(function(){
    		var suma = 0;
    		$(".sumaring").each(function(){
    			if(/^\d+$/.test($(this).val())) {
                    suma+=parseInt($(this).val()); 
                }
    	    	//suma+=parseInt($(this).val()); 
    	    	
    		});
    		
    		$("#inoe").val(suma);
    	});
    });
	
});

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje3(campo){
	var mensaje = "";
	switch(campo){
		case 'intio1':  mensaje = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
						break;
		case 'intio2':  mensaje = "Justificar el alto porcentaje de participaci&oacute;n de otros ingresos en el total de ingresos.";
		                break;
		case 'inalo':   mensaje = "Especifique el valor de ingresos por alojamiento.";
						break;
		case 'inali':   mensaje = "Justificar por qu&eacute; los ingresos por servicio de restaurante y catering para eventos son mayores que los de servicios de alojamiento."
						break;
		case 'inalo3':  mensaje = "Justifique por qu&eacute; los ingresos por alojamiento est&aacute;n en cero.";
						break;				
		case 'inoio':   mensaje = "Desagregue y justifique valor de otros ingresos operacionales.";
						break;
		case 'incat':   mensaje = "Especifique el ingreso por servicios de catering para eventos.";
						break;
		case 'inba':    mensaje = "Justificar por qu&eacute; los ingresos por bebidas alcoh&oacute;licas son mayores que los de servicio de alojamiento.";
						break;
		case 'insr':    mensaje = "Justificar por qu&eacute; los ingresos por servicios receptivos y conexos son mayores que los ingresos por alojamiento.";
						break;
		case 'inoe':    mensaje = "Justificar por qu&eacute; los ingresos por organizaci&oacute;n de eventos son mayores que los ingresos por alojamiento, y especifique los principales eventos realizados.";
						break;
		case 'intio':    mensaje = "Discrimine los otros ingresos operacionales.";
						break;
		case 'intio3': 	mensaje = "Justifique el porque sus ingresos diferentes a alojamiento son  mayores a los de alojamiento.";
						break;
	}
	return mensaje; 
	
}