//DMDIAZF - Agosto 15, 2012
//Funciones JavaScript para el modulo II de fuente
//

$(function () {

    //var mensajeGPSSDE = "Justificar el bajo sueldo y salarios del personal temporal contratado directamente por la empresa.";
    var mensajeGPPGPA = "Justificar el bajo sueldo y salarios del personal aprend&iacute;z";
    var mensajePOTTOT = "Justifique por qu&eacute; el total de personal est&aacute; en 0";
    //var mensajeGPPER = "Justifique por qu&eacute; el salario promedio del personal permanente es inferior al minimo  legal vigente.";
    var mensajeGPPER = "";
    var mensajeGPSSDE = "";
    var mensajeGPPPTA = "";
    var mensajeGPPGPA = "";

    //Configuracion inicial del formulario
    $("#tabs").tabs();
    $("#potpsfr").numerico().largo(7);
    $("#potperm").numerico().largo(7);
    $("#gpper").numerico().largo(7);
    $("#pottcde").numerico().largo(7);
    $("#gpssde").numerico().largo(7);
    $("#pottcag").numerico().largo(7);
    $("#gpppta").numerico().largo(7);
    $("#potpau").numerico().largo(7);
    $("#gppgpa").numerico().largo(7);
    $("#pottot").numerico().largo(7);
    $("#gpsspot").numerico().largo(7);
    //$("#gpsspot").hint("Sume los renglones 2,3 y 5)."); 
    //$("#potpau").hint("Universitarios, tecn&oacute;logos o t&eacute;cnicos");
    //$("#gpssde").cajaObservaciones('parseInt($("#gpssde").val()) < SMMLV',"divgpssde",mensajeGPSSDE,'obsgpssde');
    //$("#gppgpa").cajaObservaciones('parseInt($("#gppgpa").val()) < (SMMLV / 2)',"divgppgpa",mensajeGPPGPA,'obsgppgpa');  //Validaciones para justificar el salario de aprendices.
    $("#pottot").cajaObservaciones1('parseInt($("#pottot").val()) == 0', "divpottot", mensajePOTTOT, 'obspottot');
    $("#gpper").cajaObservaciones1('((parseInt($("#gpper").val()) / parseInt($("#potperm").val())) < SMMLV && parseInt($("#gpper").val()) > 0)', "divgpper", mensajeGPPER, 'obsgpper');
    $("#gpssde").cajaObservaciones1('((parseInt($("#gpssde").val()) / parseInt($("#pottcde").val())) < SMMLV && parseInt($("#gpssde").val()) > 0)', "divgpssde", mensajeGPPER, 'obsgpssde');
    $("#gpppta").cajaObservaciones1('((parseInt($("#gpppta").val()) / parseInt($("#pottcag").val())) < SMMLV && parseInt($("#gpppta").val()) > 0)', "divgpppta", mensajeGPPPTA, 'obsgpppta');
    $("#gppgpa").cajaObservaciones1('((parseInt($("#gppgpa").val()) / parseInt($("#potpau").val()) < 0.5 * SMMLV) && (parseInt($("#gppgpa").val()) > 0))', "divgppgpa", mensajeGPPGPA, 'obsgppgpa');


    /*$(document).ready(function(){
     $('.#btnModuloII').blur(function(){
     var valor = 0;
     $(".asignacero1").each(function(){
     if(parseInt($(this).val())=="") {
     valor=0; 
     }
     //suma+=parseInt($(this).val()); 
     
     });
     
     $("#potpsfr").val(valor);
     });
     });*/

    //Lanzo función ajax para saber si la fuente ha diligenciado justificaciones para este capitulo y mostrarlas en el recuadro.
    $.ajax({
        type: "POST",
        url: base_url + "fuente/obtenerObservaciones",
        data: {'campo': 0, 'modulo': 2}, //Se envia el campo en cero para que traiga todas las observaciones del modulo 2
        dataType: "html",
        cache: false,
        success: function (data) {
            var datos = eval(data);
            if (typeof (datos) != "undefined") { //Si se recibio alguna respuesta de observaciones 
                for (i = 0; i < datos.length; i++) {
                    var bloquear = "";
                    var div = "#div" + datos[i].campo;
                    var caja = "obs" + datos[i].campo;
                    datos[i].mensaje = obtenerMensaje2(datos[i].campo); //Obtengo el mensaje para la justificacion.
                    if (datos[i].bloqueo == true) {
                        var bloquear = 'disabled = "disabled"';
                    }
                    var contenido = '<p>' + datos[i].mensaje + '</p><textarea id="' + caja + '" name="' + caja + '" rows="3" style="width: 75%; border: 1px solid #CCCCCC;"' + bloquear + '>' + datos[i].descripcion + '</textarea>';
                    //Muestro el contenido dentro del div asignado
                    $(div).html(contenido);
                }
            }

        }
    });


    //Validar el formulario del modulo II (Personal Ocupado promedio y salarios causados en el mes)
    /*$("#frmModuloII").validationEngine({
     'custom_error_messages': {
     // Custom Error Messages for Validation Types
     'required': {
     'message': "Este es mi mensaje."
     }
     ,'custom[url]': {
     'message': "This validation error message will never be called"
     }
     // Custom Error Messages for IDs
     ,'#url' : {
     'custom[url]': {
     'message': "This is an id error. It takes precedence over class and validation type errors."
     }
     }
     ,'#number': {
     'min': {
     'message': "This must be greater than 0!"
     }
     }
     // Custom Error Messages for Classes
     ,'.class_url': {
     'custom[url]': {
     'message': "This is a validation message for a class. It is never called because there" +
     " is an id error message."
     }
     }
     ,'.class_req': {
     'required': {
     'message': "This is a class message. It takes precedence over validation type error messages."
     }
     }
     }
     });
     
     
     
     $('#btnModuloII').click(function(){
     var resultado =$('#frmModuloII').validationEngine('validate');
     });*/
    $(document).ready(function () {
        $(".mybuttonselector").postconfirm({ locale: {
                    title: 'title',
                    text: 'message',
                    button: ['bt_0', 'bt_1'],
                    closeText: 'X'
                }
            });
    });

    $("#frmModuloII").validate({
        rules: {
            potpsfr: {required: true,
                menorQue: 0
            },
            potperm: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#potperm").val())== 0 &&  parseInt($("#gpper").val()) > 0'
            },
            gpper: {required: true,
                expresion: 'parseInt($("#potperm").val()) > 0  &&  parseInt($("#gpper").val()) == 0'
                //expresion2: '(parseInt($("#gpper").val()) / parseInt($("#potperm").val()) < SMMLV) '
                //expresion3 : '(parseInt($("#gpper").val()) / parseInt($("#potperm").val()) > SMMLV*25)'	
            },
            pottcde: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#pottcde").val())== 0 &&  parseInt($("#gpssde").val()) > 0'
            },
            gpssde: {required: true,
                expresion: 'parseInt($("#pottcde").val()) > 0  &&  parseInt($("#gpssde").val()) == 0'
               // expresion2: 'parseInt($("#gpssde").val()) / parseInt($("#pottcde").val()) < SMMLV'
                        //expresion3 : '(parseInt($("#gpssde").val()) / parseInt($("#pottcde").val()) > SMMLV*25)'
            },
            pottcag: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#pottcag").val())== 0 &&  parseInt($("#gpppta").val()) > 0'
            },
            gpppta: {required: true,
                expresion: 'parseInt($("#pottcag").val()) > 0  &&  parseInt($("#gpppta").val()) == 0'
                //expresion2: 'parseInt($("#gpppta").val()) / parseInt($("#pottcag").val()) < SMMLV'
                        //expresion3 : 'parseInt($("#gpppta").val()) / parseInt($("#pottcag").val()) > SMMLV*25'	
            },
            potpau: {required: true,
                menorQue: 0,
                expresion: 'parseInt($("#potpau").val())== 0 &&  parseInt($("#gppgpa").val()) > 0'
            },
            gppgpa: {required: true
                //expresion  : 'parseInt($("#potpau").val()) > 0  &&  parseInt($("#gppgpa").val()) == 0',							
               // expresion2: '(parseInt($("#gppgpa").val())!=0) && (parseInt($("#gppgpa").val()) / parseInt($("#potpau").val()) < 0.5 * SMMLV)'
                        //expresion3 : 'parseInt($("#gppgpa").val()) / parseInt($("#potpau").val()) > SMMLV*25'
            },
            pottot: {required: true,
                menorQue: 0,
                igualQue: 'parseInt($("#potpsfr").val()) + parseInt($("#potperm").val()) + parseInt($("#pottcde").val()) + parseInt($("#pottcag").val()) + parseInt($("#potpau").val())'
            },
            gpsspot: {required: true,
                igualQue: 'parseInt($("#gpper").val()) + parseInt($("#gpssde").val()) + parseInt($("#gppgpa").val())'
            },
            obsgppgpa: {required: true
            },
            obspottot: {required: true
            },
            obsgpper: {required: true
            },
            obsgpssde: {required: true
            },
            obsgpppta: {required: true
            },
            obsgppgpa: {required: true
            }
        },
        messages: {
            potpsfr: {required: "Falta n&uacute;mero de personal propietario, socios y familiares.",
                menorQue: "No puede ser negativo."
            },
            potperm: {required: "Falta n&uacute;mero de personal permanente.",
                menorQue: "No puede ser negativo.",
                expresion: "Existen salarios sin personal permanente."
            },
            gpper: {required: "Falta salario de personal permanente.",
                expresion: "Existe personal permanente sin salarios."
                //expresion2: "<br/>El salario promedio del personal permanente no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 :  "<br/>El salario promedio del personal permanente no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."			
            },
            pottcde: {required: "Falta n&uacute;mero de personal temporal directo.",
                menorQue: "No puede ser negativo.",
                expresion: "Existen salarios sin personal temporal directo."
            },
            gpssde: {required: "Falta salario del personal temporal directo.",
                expresion: "Existe personal temporal directo sin salarios."
                //expresion2: "<br/>El salario promedio del personal temporal directo no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal temporal directo no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            pottcag: {required: "Falta n&uacute;mero de personal temporal indirecto.",
                menorQue: "No puede ser negativo.",
                expresion: "Hay un valor cobrado por otras empresas sin que suministren personal temporal."
            },
            gpppta: {required: "Falta salario de personal temporal indirecto.",
                expresion: "Hay personal temporal con otras empresas sin un valor cobrado por dichas empresas."
                //expresion2: "<br/>El salario promedio del personal temporal indirecto no puede ser menor que el salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal temporal indirecto no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            potpau: {required: "Falta n&uacute;mero de personal aprendiz o estudiante.",
                menorQue: "No puede ser negativo.",
                expresion: "Hay gastos por personal aprendiz sin personas en esta categoria."
            },
            gppgpa: {required: "Falta salario de personal aprendiz o estudiante."
                //expresion  : "Existe personal aprendiz, pero no hay gastos causados por estos."
                //expresion2: "<br/>El salario promedio del personal aprendiz no puede ser menor que el 50% del salario m&iacute;nimo mensual legal vigente. Promedie el personal si hay personas que no trabajaron todo el mes."
                        //expresion3 : "<br/>El salario promedio del personal aprendiz no puede ser mayor a 25 salarios m&iacute;nimos mensuales legales vigentes. Promedie el personal si hay personas que no trabajaron todo el mes."
            },
            pottot: {required: "Falta personal ocupado.",
                menorQue: "No puede ser negativo.",
                igualQue: "La suma no corresponde."
            },
            gpsspot: {required: "Falta salario del personal ocupado.",
                igualQue: "La suma no corresponde."
            },
            obsgppgpa: {required: "Justifique."
            },
            obspottot: {required: "Justifique."
            },
            obsgpper: {required: "Justifique."
            },
            obsgpssde: {required: "Justifique."
            },
            obsgpppta: {required: "Justifique."
            },
            obsgppgpa: { required: "Justifique."
            }
        },
        errorPlacement: function (error, element) {
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
        submitHandler: function (form) {
            $('#potpsfr').change(function(){
		$(this).css({'border':''});
		if($(this).val() > 0){
                        $('#aviso').html('');
                }
            });
            if (parseInt($("#potpsfr").val()) == 0) {
                var del = confirm('¿Esta seguro que desea registrar el valor de personal propietarios, socios y familiares en 0?');
                if (del) {
                    cierto = 1;
                } else {
                    $('#potpsfr').each(function(){
                        $(this).css({'border':''});
                        if($(this).val() == 0){
                            $("#aviso").css('opacity','0.67');
                            $("#aviso").css('z-index','991');
                            $("#aviso").css('background','#ee0101');
                            $("#aviso").css("position","absolute");
                            //$("#aviso").css('margin-top','1px');
                            $("#aviso").css('color','#fff');
                            $("#aviso").css('font-size','11px');
                            $("#aviso").css('border','2px solid #ddd');
                            //$("#aviso").css('box-shadow','0 0 6px #000');
                            //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
                            //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
                            //$("#aviso").css('padding','4px 10px 4px 10px');
                            $("#aviso").css('border-radius','6px');
                            $("#aviso").css('-moz-border-radius','6px');
                            $("#aviso").css('-webkit-border-radius','6px');
                            $("#aviso").css("font-weight","bolder");
                            $('#aviso').html('Corrija el valor de personal propietarios, socios y familiares. <br />');
                            $("#aviso").effect('slide','',1500,'');	
                            $(this).css({'border':'3px solid red'});
                        }
                    });
                    return false;
                }
            } else {
                cierto = 2;
            }
            if (cierto == 1 || cierto == 2) {
                $.ajax({
                    type: "POST",
                    url: base_url + "fuente/actualizarModuloII",
                    data: $("#frmModuloII").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        var image = $("#imgtab2");
                        image.attr("src", base_url + "/images/tick.png");
                        $("#tabs").tabs({selected: 2});
                    }
                });
            }
        }
    });
    
    $('#gpper').blur(function(){
        if((parseInt($(this).val())/parseInt($("#potperm").val())) < SMMLV && parseInt($(this).val())>0){
            $//("#mensajegpper").val(suma);
            $("#mensajegpper").css('opacity','0.67');
            $("#mensajegpper").css('z-index','991');
            $("#mensajegpper").css('background','#ee0101');
            $("#mensajegpper").css("position","relative");
            //$("#aviso").css('margin-top','1px');
            $("#mensajegpper").css('color','#fff');
            $("#mensajegpper").css('font-size','11px');
            $("#mensajegpper").css('border','2px solid #ddd');
            //$("#aviso").css('box-shadow','0 0 6px #000');
            //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
            //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
            //$("#aviso").css('padding','4px 10px 4px 10px');
            $("#mensajegpper").css('border-radius','6px');
            $("#mensajegpper").css('-moz-border-radius','6px');
            $("#mensajegpper").css('-webkit-border-radius','6px');
            $("#mensajegpper").css("font-weight","bolder");
            $('#mensajegpper').html('El salario promedio del personal permanente es menor que el salario m&iacute;nimo mensual legal vigente, ver manual de diligenciamiento. CORRIJA O JUSTIFIQUE.</br>');
            //$("#mensajegpper").effect('slide','',1500,'');	
            $(this).css({'border':'3px solid red'})
        }else{
            $("#mensajegpper").css('border','0px solid #ddd');
            $('#mensajegpper').html('');
            $(this).css({'border':'1px solid #DFDFDF'})
        }
    });
    
    $('#gpssde').blur(function(){
        if((parseInt($(this).val())/parseInt($("#pottcde").val())) < SMMLV && parseInt($(this).val()) > 0){
            $//("#mensajegpper").val(suma);
            $("#mensajegpssde").css('opacity','0.67');
            $("#mensajegpssde").css('z-index','991');
            $("#mensajegpssde").css('background','#ee0101');
            $("#mensajegpssde").css("position","relative");
            //$("#aviso").css('margin-top','1px');
            $("#mensajegpssde").css('color','#fff');
            $("#mensajegpssde").css('font-size','11px');
            $("#mensajegpssde").css('border','2px solid #ddd');
            //$("#aviso").css('box-shadow','0 0 6px #000');
            //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
            //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
            //$("#aviso").css('padding','4px 10px 4px 10px');
            $("#mensajegpssde").css('border-radius','6px');
            $("#mensajegpssde").css('-moz-border-radius','6px');
            $("#mensajegpssde").css('-webkit-border-radius','6px');
            $("#mensajegpssde").css("font-weight","bolder");
            $('#mensajegpssde').html('Salario promedio del personal temporal contratado directamente es inferior al minimo  legal vigente, ver manual de diligenciamiento. CORRIJA O JUSTIFIQUE.<br />');
            //$("#mensajegpper").effect('slide','',1500,'');	
            $(this).css({'border':'3px solid red'})
        }else{
            $("#mensajegpssde").css('border','0px solid #ddd');
            $('#mensajegpssde').html('');
            $(this).css({'border':'1px solid #DFDFDF'})
        }
    });
    
    $('#gpppta').blur(function(){
        if((parseInt($(this).val())/parseInt($("#pottcag").val())) < SMMLV && parseInt($(this).val()) > 0){
            $//("#mensajegpper").val(suma);
            $("#mensajegpppta").css('opacity','0.67');
            $("#mensajegpppta").css('z-index','991');
            $("#mensajegpppta").css('background','#ee0101');
            $("#mensajegpppta").css("position","relative");
            //$("#aviso").css('margin-top','1px');
            $("#mensajegpppta").css('color','#fff');
            $("#mensajegpppta").css('font-size','11px');
            $("#mensajegpppta").css('border','2px solid #ddd');
            //$("#aviso").css('box-shadow','0 0 6px #000');
            //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
            //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
            //$("#aviso").css('padding','4px 10px 4px 10px');
            $("#mensajegpppta").css('border-radius','6px');
            $("#mensajegpppta").css('-moz-border-radius','6px');
            $("#mensajegpppta").css('-webkit-border-radius','6px');
            $("#mensajegpppta").css("font-weight","bolder");
            $('#mensajegpppta').html('Salario promedio del personal temporal contratado a trav&eacute;s de empresas especializadas es inferior al m&iacute;nimo legal vigente, ver manual de diligenciamiento.   CORRIJA O JUSTIFIQUE.<br />');
            //$("#mensajegpper").effect('slide','',1500,'');	
            $(this).css({'border':'3px solid red'})
        }else{
            $("#mensajegpppta").css('border','0px solid #ddd');
            $('#mensajegpppta').html('');
            $(this).css({'border':'1px solid #DFDFDF'})
        }
    });
    
    $('#gppgpa').blur(function(){
        //alert(parseInt($("#potpau").val()));
        if(parseInt($(this).val()) / parseInt($("#potpau").val()) < 0.5 * SMMLV && parseInt($(this).val()) != 0){
            $//("#mensajegpper").val(suma);
            $("#mensajegppgpa").css('opacity','0.67');
            $("#mensajegppgpa").css('z-index','991');
            $("#mensajegppgpa").css('background','#ee0101');
            $("#mensajegppgpa").css("position","relative");
            //$("#aviso").css('margin-top','1px');
            $("#mensajegppgpa").css('color','#fff');
            $("#mensajegppgpa").css('font-size','11px');
            $("#mensajegppgpa").css('border','2px solid #ddd');
            //$("#aviso").css('box-shadow','0 0 6px #000');
            //$("#aviso").css('-moz-box-shadow','0 0 6px #000');
            //$("#aviso").css('-webkit-box-shadow','0 0 6px #000');
            //$("#aviso").css('padding','4px 10px 4px 10px');
            $("#mensajegppgpa").css('border-radius','6px');
            $("#mensajegppgpa").css('-moz-border-radius','6px');
            $("#mensajegppgpa").css('-webkit-border-radius','6px');
            $("#mensajegppgpa").css("font-weight","bolder");
            $('#mensajegppgpa').html('El salario promedio del personal apredices y pasantes es inferior al 50% del salario minimo mensual  legal vigente. Ver manual de diligenciamiento,  CORRIJA O JUSTIFIQUE.<br />');
            //$("#mensajegpper").effect('slide','',1500,'');	
            $(this).css({'border':'3px solid red'})
        }else{
            $("#mensajegppgpa").css('border','0px solid #ddd');
            $('#mensajegppgpa').html('');
            $(this).css({'border':'1px solid #DFDFDF'})
        }
    });
    
    /*$('#pottcde').blur(function(){
        $("#mensajegpper").css('border','0px solid #ddd');
        $('#mensajegpper').html('');
        $(this).css({'border':'1px solid #DFDFDF'})
    });   */ 

});


//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje2(campo) {
    var mensaje = "";
    switch (campo) {
        case 'pottot':
            mensaje = "Justifique por qu&eacute; el total de personal est&aacute; en 0";
            break;
        case 'gpper':
            mensaje = "Justifique por qu&eacute; el salario promedio del personal permanente es inferior al minimo  legal vigente";
            break;
        case 'gpssde':
            mensaje = "Justifique por qu&eacute; el salario promedio del personal temporal contratado directamente por el hotel es inferior al minimo  legal vigente";
            break;
        case 'gpppta':
            mensaje = "Justifique por qu&eacute; el salario promedio del personal temporal contratado a trav&eacute;s de otras empresas es inferior al minimo  legal vigente";
            break;
        case 'gppgpa':
            mensaje = "Justifique por qu&eacute; el salario promedio del personal apredices y pasantes es inferior al 50% del salario minimo mensual  legal vigente";
            break; 
        default:
            mensaje = "Justificar el bajo sueldo y salarios del personal aprend&iacute;z";
            break;
    }
    return mensaje;
}

//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje3(campo) {
    var mensaje = "";
    switch (campo) {
        case 'intio1':
            mensaje = "Justificar el bajo porcentaje de ingresos por alojamiento en el total de ingresos.";
            break;
        case 'intio2':
            mensaje = "Justificar el alto porcentaje de participaci&oacute;n de otros ingresos en el total de ingresos.";
            break;
        case 'inalo':
            mensaje = "Especifique el valor de ingresos por alojamiento.";
            break;
        case 'inoio':
            mensaje = "Desagregue el valor de otros ingresos netos operacionales no incluidos.";
            break;
    }
    return mensaje;
}




//Funcion para obtener los mensajes de las cajas de texto de las justificaciones
function obtenerMensaje4(campo) {
    var mensaje = "";
    switch (campo) {
        case 'ihoa':
            mensaje = "Justifique por qu&eacute; durante el mes, el n&uacute;mero de habitaciones vendidas fue mayor que el de habitaciones disponibles.";
            break;
        case 'icva':
            mensaje = "En el mes el n&uacute;mero de camas vendidas fue mayor que el n&uacute;mero de camas disponibles &iquest;Se vendieron camas supletorias?";
            break;
        case 'inalosen':
            mensaje = "Si por el tipo de habitaci&oacute;n sencilla s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
            break;
        case 'inalodob':
            mensaje = "Si por el tipo de habitaci&oacute;n doble s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
            break;
        case 'inalosui':
            mensaje = "Si por el tipo de habitaci&oacute;n suite s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
            break;
        case 'inalomul':
            mensaje = "Si por el tipo de habitaci&oacute;n m&uacute;ltiple s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
            break;
        case 'inalootr':
            mensaje = "Si por otro tipo de habitaci&oacute;n s&oacute;lo se diligencia los ingresos de alojamiento el rubro deber&iacute;a ser menor o igual al ingreso total.";
            break;
    }
    return mensaje;
}