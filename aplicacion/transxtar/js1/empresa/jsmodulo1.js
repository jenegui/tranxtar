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
	$("#iddepto").cargarCombo("idmpio","empresa/actualizarmunicipios");  
	$("#idtelno").numerico().largo(13);
	$("#esini").numerico().largo(3);
	$("#esape").numerico().largo(3);
	$("#escie").numerico().largo(3);
	$("#estot").numerico().largo(3);
	$("#idfaxno").numerico().largo(13);
	$("#idpagweb").minusculas().largo(255);
	$("#idcorreo").minusculas().largo(80);	
	$("#finicial").datepicker();
	$("#ffinal").datepicker();
	//$("#ffinal").hint("Referente al periodo que se ofreci&oacute; el servicio de alojamiento - Fecha de operaci&oacute;n.");
	$("#idnomcomest").mayusculas().largo(60);
	$("#idsiglaest").mayusculas().largo(20);
	$("#iddireccest").mayusculas().largo(40);
	$("#iddeptoest").cargarCombo("idmpioest","empresa/actualizarmunicipios");
	$("#idtelnoest").numerico().largo(13);	
	$("#idfaxnoest").numerico().largo(13);
	$("#idcorreoest").minusculas().largo(80);
	
	//Validar el formulario del modulo I (Caratula)
	//$("#btnModuloI").click(function(){
		$("#frmModuloI").validate({
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
						url: base_url + "empresa/actualizarModuloI",
						data: $("#frmModuloI").serialize(),
						dataType: "html",
						cache: false,
						success: function(data){
							//alert(data);
							//alert(base_url);
							alert('El registro se guardó exitosamente.');
							/*var image = $("#imgtab1");
					   		image.attr("src", base_url + "/images/tick.png");						    
					   		$("#tabs").tabs({selected: 1});	*/				   							   							   								   								   		
						}
					});
				}								
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
				idcorreo : {	email      : "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."					
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
				idcorreoest : {	email      : "Digite un correo v&aacute;lido (xxxxxx@xxxx.com)."
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
						url: base_url + "empresa/actualizarModuloEst",
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