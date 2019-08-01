//DMDIAZF - Agosto 15, 2012
//Funciones JavaScript para el modulo 1 de fuente
//

$(function(){
	
	//Configuracion inicial del formulario
	$("#tabs").tabs();
	$("#idproraz").mayusculas().largo(60);
	//$("#idnomcom").mayusculas().largo(60);	
	//$("#idsigla").mayusculas().largo(20);	
	$("#iddirecc").mayusculas().largo(40);	
	$("#iddepto").cargarCombo("idmpio","miniencuesta/actualizarmunicipios");  
	$("#idtelno").numerico().largo(13);
	$("#esini").numerico().largo(3);
	$("#esape").numerico().largo(3);
	$("#escie").numerico().largo(3);
	$("#estot").numerico().largo(3);
	$("#idfaxno").numerico().largo(13);
	$("#idpagweb").minusculas().largo(255);
	$("#idcorreo").minusculas().largo(150);
        $("#idnit").numerico().largo(10);
        $("#iddv").numerico().largo(1);
        $("#idnitNuevo").numerico().largo(10);
        $("#iddvNuevo").numerico().largo(1);
        $("#pottot").numerico().largo(4);
        $("#ihdo").numerico().largo(4);
        $("#icda").numerico().largo(4);
        $("#intio").numerico().largo(12);
        $("#inalo").numerico().largo(12);
        $("#responde").mayusculas().largo(35);
        $("#respoca").mayusculas().largo(30);
        $("#teler").numerico().largo(13);
        $("#emailr").minusculas().largo(150);
        
	$("#finicial").datepicker();
	$("#ffinal").datepicker();
	//$("#ffinal").hint("Referente al periodo que se ofreci&oacute; el servicio de alojamiento - Fecha de operaci&oacute;n.");
	$("#idnomcomest").mayusculas().largo(60);
	$("#idsiglaest").mayusculas().largo(20);
	$("#iddireccest").mayusculas().largo(40);
	$("#iddeptoest").cargarCombo("idmpioest","miniencuesta/actualizarmunicipios");
	$("#idtelnoest").numerico().largo(13);	
	$("#idfaxnoest").numerico().largo(13);
	$("#idcorreoest").minusculas().largo(80);
	
        $("#observacionesCR").hide();
        
        if((typeof(numord)!="undefined")&&(typeof(numest)!="undefined")){
		
		//Lanzo funciï¿½n ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en el recuadro. (Modulo 2)
		$.ajax({
			type: "POST",
			url: base_url + "critico/obtenerObservaciones/"+numord+"/"+numest,
			data: {'campo': 0, 'modulo': 1}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 2
			dataType: "html", 
		    cache: false,
			success: function(data){
				var datos = eval(data);
				if(typeof(datos) != "undefined"){ //Si se recibio alguna respuesta de observaciones 
					for (i=0; i<datos.length; i++){
						var bloquear = "";
						var div = "#div" + datos[i].campo;
						var caja = "obs" + datos[i].campo;
						datos[i].mensaje = obtenerMensaje2(datos[i].campo); //Obtengo el mensaje para la justificacion.
						if (datos[i].bloqueo==true){
							var bloquear = 'disabled = "disabled"';
						}					
						var contenido = '<p>'+datos[i].mensaje+'</p><textarea id="'+caja+'" name="'+caja+'" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"'+ bloquear +' disabled>'+datos[i].descripcion+'</textarea>';
						//Muestro el contenido dentro del div asignado
						$(div).html(contenido);										
					}				
				}																
			}					
		});
		
        } 
        
        $("#btnModuloI").click(function(){
            if($("#frmModuloI").valid()){
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
                        var del = confirm('Haga click en "Aceptar" para guardar y enviar, o en "Cancelar" si no está seguro de la información registrada.');
                        if (del) {
                            $cierto=1;
                        } else {
                            return false;
                        }
                        $.ajax({
                                type: "POST",
                                url: base_url + "miniencuesta/actualizarModuloI",
                                data: $("#frmModuloI").serialize(),
                                dataType: "html",
                                cache: false,
                                success: function(data){
                                    if($cierto==1){
                                        location.reload();
                                    }   
                                    //location.href =base_url + "miniencuesta/index";
                                    /*$("#aviso").css('opacity','0.87');
                                    $("#divGuardo").css('z-index','991');
                                    $("#divGuardo").css('background','#ee0101');
                                    $("#divGuardo").css("position","absolute");
                                    //$("#aviso").css('margin-top','1px');
                                    $("#divGuardo").css('color','#fff');
                                    $("#divGuardo").css('font-size','15px');
                                    $("#divGuardo").css('border','2px solid #ddd');
                                    //$("#aviso").css('box-shadow','0 0 6px #000');
                                    //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
                                    //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
                                    //$("#aviso").css('padding','4px 10px 4px 10px');
                                    $("#divGuardo").css('border-radius','6px');
                                    $("#divGuardo").css('-moz-border-radius','6px');
                                    $("#divGuardo").css('-webkit-border-radius','6px');
                                    $("#divGuardo").css("font-weight","bolder");
                                    $('#divGuardo').html('El registro se guardó exitosamente. <br />');
                                    $("#divGuardo").effect('slide','',1500,'');	
                                    $(this).css({'border':'3px solid red'});*/				   							   							   								   								   		
                                }
                        });
                }
            }
	});
        
        $("#btnOBSCriticaI").click(function(){
            if($("#frmModuloI").valid()){
                $("#hddCapitulo").val(1);
                $("#txaObservacionesCR").val("");
                $("#observacionesCR").dialog({
                        width: 480,
                        title: 'Observaciones de Cr&iacute;tica',
                        modal: true			
                });
                $("#tabs").tabs({selected: 0});			
            }		
	});
        
        //Ejecutar las funciones AJAX para guardar los comentarios de la crï¿½tica
	$("#btnGuardarCriticaCR").click(function(){
		//Guardar los datos del formulario
		var formulario = "";
		switch($("#hddCapitulo").val()){
			case '1':  formulario = "#frmModuloI";			           
			           break;
			case '2':  formulario = "#frmModuloII";					   
					   break;
			case '3':  formulario = "#frmModuloIII";					   
                       break;
			case '4':  formulario = "#frmModuloIV";					   
                       break;
			case '5':  formulario = "#frmModuloV";
	                   break;           
			default:   formulario = "#frmModuloEnvio";					   
                       break;			
		}
		//Valida que digiten las observaciones
		if($("#txaObservacionesCR").val() == '')
		{
			alert ('Por favor digite las observaciones...');
			return false;
		}
		else
		{
			$.ajax({
				type: "POST",
				url: base_url + "critico/guardarCapitulo",
				data: {'observacion': $("#txaObservacionesCR").val(), 'capitulo':$("#hddCapitulo").val(), 'form': $(formulario).serialize()},
				dataType: "html",
			    cache: false,
				success: function(data){				
					$("#observacionesCR").dialog("close");
					location.reload(); //Recargar la pagina.								
				}
			});		
		}
	});
        
	//Validar el formulario del modulo I (Caratula)
	//$("#btnModuloI").click(function(){
		$("#frmModuloI").validate({
			rules : {
				idproraz : {	required   :  true,
                                                alfanumerico : true
				},
                                idnomcom : {	required   :  true,
                                                alfanumerico : true
				},
				idnit   : {     required    : true,
                                                expresion  : 'parseInt($("#idnit").val())>= 9999999999 ||  parseInt($("#idnit").val()) <= 9999'
                                },
                                iddv   : {     required    : true,
                                               expresion  : 'parseInt($("#iddv").val())>= 10 || parseInt($("#iddv").val())< 0'
                                },
                                cambioNit   : {	comboBox   :  '-'
				},
                                idnitNuevo   : {     required    : true,
                                                    expresion  : 'parseInt($("#idnitNuevo").val())>= 9999999999 ||  parseInt($("#idnitNuevo").val()) <= 9999'
                                },
                                iddvNuevo   : {     required    : true,
                                               expresion  : 'parseInt($("#iddvNuevo").val())>= 10 || parseInt($("#iddvNuevo").val())< 0'
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
				idcorreo : {	email      :  true,
                                                required   :  true
				},
                                pottot   :  {   required    : true
                                },
                                ihdo   :  {     required    : true
                                },
                                icda   :  {     required    : true,
                                                expresion  : 'parseInt($("#icda").val()) < parseInt($("#ihdo").val())'
                                },
                                intio   :  {    required    : true
                                },
                                inalo   :  {    required    : true,
                                                expresion  : 'parseInt($("#inalo").val()) > parseInt($("#intio").val())'
                                },
                                responde   :  {    required    : true
                                },
                                respoca   :  {    required    : true
                                },
                                teler   :  {    required    : true
                                },
                                emailr   :  {   email      :  true, 
                                                required    : true
                                },
				finicial : {	required   :  true									
				},
				ffinal   : {	required   :  true															
				},
				idnomcomest: {  required   :  true
				},
				idsiglaest: {   maxlength  :  20
				},
				iddireccest : {	required   :  true	
				}, 
				idactivest : {  required   : true,	
                                                comboBox   :  '-'
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
				esini  : {	required   :  true
                                },
				esape  : {	required   :  true
                                },
				escie  : {	required   :  true
                                },
				estot  : {	required   :  true
                                },
                                observacionesCritica: {	required   : true
                                }
			}, 
			messages : {
				idproraz : {	required   :  "Falta la raz&oacute;n social.",
                                                alfanumerico:  "El campo debe ser alfanumerico."
				},
                                idnomcom : {	required   :  "Falta nombre comercial.",
                                                alfanumerico:  "El campo debe ser alfanumerico."
				},
				idnit : {	required   :  "Falta NIT.",
                                                expresion    : "NIT fuera de rango."
                                                //mayorQue    : "NIT fuera de rango."
				},
                                iddv : {	required   :  "Falta digito de verificación.",
                                                expresion    : "Digito de verificación no corresponde."
				},
                                cambioNit   : {	comboBox   :  "Seleccione Si o No."
				},
                                idnitNuevo : {	required   :  "Falta NIT nuevo.",
                                                expresion    : "NIT fuera de rango."
                                                //mayorQue    : "NIT fuera de rango."
				},
                                iddvNuevo : {	required   :  "Falta digito de verificación nuevo.",
                                                expresion    : "Digito de verificación no corresponde."
				},
				iddirecc : {	required   :  "Falta la dirección de la gerencia."					
				},
				iddepto  : {	comboBox   :  "Falta el nombre del departamento."						
				},
				idmpio   : {	comboBox   :  "Falta el nombre del municipio."
				},
				idtelno  : {	required   :  "Falta número de teléfono.",
					            min        :  "Minimo 7 Digitos."
				},
				idpagweb : {    required   : "",
						url        : "Digite una direcci&oacute;n v&aacute;lida (http://www.xxxxx.com)."
				},
				idcorreo : {	email      : "Digite un correo válido (xxxxxx@xxxx.com).",
                                                required   : "Falta correo electronico"
				},
                                pottot    : { required      : "Falta personal ocupado promedio. " 
                                },
                                ihdo    : { required      : "Falta número de habitaciones ofrecidas día. " 
                                },
                                icda    : { required      : "Falta número  de camas ofrecidas día." ,
                                            expresion    : "Número de camas ofrecidas dia menor que el n&uacute;mero de habitaciones ofrecidas día, corrija."
                                },
                                intio    : { required      : "Falta Ingresos totales causados en el mes. " 
                                },
                                inalo    : { required      : "Falta Ingresos por alojamiento. " ,
                                            expresion    : " Ingresos por alojameinto mayor que ingresos totales."
                                },
                                responde   :  {    required    : "Falta nombre de la persona que diligencia"
                                },
                                respoca   :  {    required    : "Falta cargo de quien diligencia"
                                },
                                teler   :  {    required    : "Falta número de tel&eacute;fono"
                                },
                                emailr   :  {   email      : "Digite un correo válido (xxxxxx@xxxx.com).", 
                                                required    : "Falta  correo de la persona que responde"
                                },
				finicial : {	required   : "Falta fecha inicial."										
				},
				ffinal   : {	required   : "Falta fecha final."
				},
				idnomcomest: {  required   : "Falta nombre comercial establecimiento."
				},
				idsiglaest: {   maxlength  : "M&aacute;ximo 20 caracteres."
				},
				iddireccest : {	required   : "Falta la direcci&oacute;n del establecimiento."
				},
				idactivest : {  required   : "Falta la actividad del establecimiento.",	
								comboBox   : "Falta la actividad del establecimiento."
				},
				iddeptoest  : {	comboBox   : "Falta el nombre del departamento."						
				},
				idmpioest   : {	comboBox   : "Falta el nombre del municipio."
				},
				idtelnoest  : {	required   : "Falta número de tel&eacute;fono.",
		                         min       : "M&iacute;nimo 7 D&iacute;gitos."
				},
				idcorreoest : {	email      : "Si no est&aacute; diligenciado no incluya leyendas, dejar en blanco."
				},
				esini  : {	required   : "Falta número de establecimientos iniciales."
                                },
				esape  : {	required   : "Falta número de establecimientos abiertos."
                                },
				escie  : {	required   : "Falta número de establecimientos cerrados."
                                },
				estot  : {	required   : "Falta número total de establecimientos." 
                                },
                                observacionesCritica: {	required   : "digite las observaciones de la crítica"
                                }
			},
			errorPlacement: function(error, element) {
				//Mostrar el error en la parte de abajo de la caja de texto.
				element.after(error);		        
				error.css('opacity', '0.57');
                                error.css('z-index', '991');
                                error.css('background', '#ee0101');
                                //error.css('float','right');
                                error.css('position', 'absolute');
                                error.css('margin-top', '1px');
                                error.css('color', '#fff');
                                error.css('font-size', '11px');
                                error.css('border', '2px solid #ddd');
                                error.css('box-shadow', '0 0 6px #000');
                                error.css('-moz-box-shadow', '0 0 6px #000');
                                error.css('-webkit-box-shadow', '0 0 6px #000');
                                error.css('padding', '4px 10px 4px 10px');
                                error.css('border-radius', '6px');
                                error.css('-moz-border-radius', '6px');
                                error.css('-webkit-border-radius', '6px');
			},
			submitHandler: function(form) {
                            //No se ejecuta nada.
                            //Solo se indica si el formulario fue valido o no.
			}
		});
		
               //Validar el formulario del modulo I (establecimientos)
		$("#frmModuloEst").validate({
			rules : {
				idproraz : {	required   :  true
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
				idnomcomest: {  required   :  true
				},
				idsiglaest: {   maxlength  :  20
				},
				iddireccest : {	required   :  true	
				},
				idactivest : {  required   : true,	
					            comboBox   :  '-'
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
				esini  : {	required   :  true
                },
				esape  : {	required   :  true
                },
				escie  : {	required   :  true
                },
				estot  : {	required   :  true
                }
			},
			messages : {
				idproraz : {	required   :  "Falta la raz&oacute;n social."		
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
								url        : "Si no est&aacute; diligenciado no incluya leyendas, dejar en blanco."
				},
				idcorreo : {	email      : "Si no est&aacute; diligenciado no incluya leyendas, dejar en blanco."					
				},
				finicial : {	required   : "Falta fecha inicial."										
				},
				ffinal   : {	required   : "Falta fecha final."
				},
				idnomcomest: {  required   : "Falta nombre comercial establecimiento."
				},
				idsiglaest: {   maxlength  : "M&aacute;ximo 20 caracteres."
				},
				iddireccest : {	required   : "Falta la direcci&oacute;n del establecimiento."
				},
				idactivest : {  required   : "Falta la actividad del establecimiento.",	
					            comboBox   : "Falta la actividad del establecimiento."
	            },
				iddeptoest  : {	comboBox   : "Falta el nombre del departamento."						
				},
				idmpioest   : {	comboBox   : "Falta el nombre del municipio."
				},
				idtelnoest  : {	required   : "Falta n&uacute;mero de tel&eacute;fono.",
		                         min       : "M&iacute;nimo 7 D&iacute;gitos."
				},
				idcorreoest : {	email      : "Si no est&aacute; diligenciado no incluya leyendas, dejar en blanco."
				},
				esini  : {	required   : "Falta n&uacute;mero de establecimientos iniciales."
                },
				esape  : {	required   : "Falta n&uacute;mero de establecimientos abiertos."
                },
				escie  : {	required   : "Falta n&uacute;mero de establecimientos cerrados."
                },
				estot  : {	required   : "Falta n&uacute;mero total de establecimientos." 
                }
			},
			errorPlacement: function(error, element) {
				//Mostrar el error en la parte de abajo de la caja de texto.
				element.after(error);		        
				error.css('display','block');
				error.css('float','none');
				error.css('vertical-align','top');
				error.css('margin-left','10px');				
				error.css('color',"#FF0000");
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
						url: base_url + "miniencuesta/actualizarModulo",
						data: $("#frmModuloEst").serialize(),
						dataType: "html",
						cache: false,
						success: function(data){
							alert('El registro se guardó exitosamente.');
							location.reload();
							location.href =base_url + "empresa/index";
						}
					});
				}								
			}
		});
		
		
		
		//Validar el formulario del modulo I (cierre de establecimientos)
		$("#frmCierreEst").validate({
			rules : {
				motivoCierre : {	required   :  true
				}
			},
			messages : {
				motivoCierre : {	required   :  "Complete las observacones."		
				}
			},
			errorPlacement: function(error, element) {
				//Mostrar el error en la parte de abajo de la caja de texto.
				element.after(error);		        
				error.css('display','block');
				error.css('float','none');
				error.css('vertical-align','top');
				error.css('margin-left','10px');				
				error.css('color',"#FF0000");
			},
			submitHandler: function(form) {
				$("#divError").html("");
				$.ajax({
					type: "POST",
					url: base_url + "empresa/actualizarCierreEst",
					data: $("#frmCierreEst").serialize(),
					dataType: "html",
					cache: false,
					success: function(data){
						
						alert('El registro se guardó exitosamente.');
						location.reload();
						location.href =base_url + "empresa/index";
					}
				});
											
			}
		});
	//});
	
		
		/*$(document).ready(function(){
	    	$('.sumar1').blur(function(){
	    		var suma = 0;
	    		$(".sumar1").each(function(){
	    	    	suma+=parseInt($(this).val());
	    	    	
	    		});
	    		
	    		$("#estot").val(suma);
	    	});
	    });*/
		 $(document).ready(function(){
		    	$("input[type='text']").change(function(){
			    	var suma = 0;
			    	suma = Number($("input[id='esini']").val());
			    	suma += Number($("input[id='esape']").val());
			    	suma -= Number($("input[id='escie']").val());
			    	var contenido ='4. Total nacional en el mes:&nbsp;<input type="text" name="estot" id="estot" size="3" maxlength="3" value="'+suma+'" readonly>'
			    	//$("#resultado").text(suma);
			    	$("#estot").html(contenido);
		    	});
		    });   
		
		
	
});

function abrir_dialog1() {
	 $( "#dialog1" ).dialog({
	      modal: true,
	      //consecutivo:consecutivo,
	      draggable: false,
	      resizable: false,
	      position: ['center', 'top'],
	      show: 'blind',
	      hide: 'blind',
	      width: 650,
	      dialogClass: 'ui-dialog-osx'
	      /*buttons: {
	          "Cerrar": function() {
	              $(this).dialog("close");
	          }
	      }*/
   	
     });
};

$(document).ready(function(){ 
    $("#cambioNit").change(function () {
           $("#cambioNit option:selected").each(function () {
            var nit=$(this).val();
            //alert (nit);
            if(nit=='S'){
               // $("#formularioRubros").css("display", "block");
                $("#mostarCampoNit").show();
                $("#mostarCampoNit1").show();
                //$("#formularioAplicara").hide();
            }else{
                //$("#formularioRubros").css("display", "none");
                $("#mostarCampoNit").hide();
                $("#mostarCampoNit1").hide();
                //$("#formularioAplicara").show();
             }

        });
   })
 });