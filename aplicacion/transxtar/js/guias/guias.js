 jQuery(function () {
    $(function () {
        $("#alto").numerico();
        $("#ancho").numerico();
        $("#largo").numerico();
        $("#unidades").numerico();
        $(".cantidad").numerico();
        $("#pesokg").numerico();
        $("#pesovolumen").numerico();
        $("#pesocobrar").numerico();
        $("#flete").numerico();
        $("#valorDeclarado").numerico();
        $("#totalflete").numerico();
        $("#txtNomDest").mayusculas();
        $("#numplaca").mayusculas();
        $("#nom_contacto").mayusculas();
        $("#idestablecimiento").select2();
        $("#idestab").select2();
        $("#iddestinatario").select2();
        $("#idoperario").select2();
        $("#idoperarioext").select2();
        $("#idmpioDest").select2();
        $("#tipo_tarifa").select2();
        $("#formaPago").select2();
        $("#idestab").cargarCombo("iddestinatario", "guias/actualizarDestinatarios");
        $("#iddestinatario").cargarCombo("idmpioDest", "guias/actualizarMunicipios");
        $("#txtFecRecogida").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy', //Se especifica como deseamos representarla
            firstDay: 1
        });

        $.validator.addMethod("comboBox",function (value, element, param) {
        var idx = (param).toString(); 
        if($(element).val()==idx)
            return false;
        else
            return true;
        },"");

        $.validator.addMethod("expresion",function(value, element, param){
            var comp = convertirExpresion(param);
            if (comp){
                return false;
            }   
            else{
                return true;
            }
        },"");

        $("#btnConsultarCliente").click(function () {
            //alert("mmm");
            $("#frmConsultarCliente").validate({
                rules: {
                    idestab: {
                        required: true,
                        comboBox: '-'
                    },
                    iddestinatario: {
                        required: true,
                        comboBox: '-'
                    },
                    tipo_tarifa: {
                        required: true,
                        comboBox: '-'
                    },
                },
                messages: {
                    idestab: {required: "Debe seleccionar un cliente",
                    comboBox: "Debe seleccionar un cliente"
                    },
                    iddestinatario: {required: "Debe seleccionar un destinatario",
                    comboBox: "Debe seleccionar un destinatario"
                    },
                    tipo_tarifa: {required: "Debe seleccionar un tipo de tarifa",
                    comboBox: "Debe seleccionar un tipo de tarifa"
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
                    form.submit();
                    $.ajax({
                        type: "POST",
                        url: base_url + "login/validar",
                        data: $("#frmConsultarCliente").serialize(),
                        dataType: "html",
                        cache: false,
                        success: function (data) {
                            //alert(url);
                            $("#agregarEmpresa").dialog('close');
                        }
                    });
                }
            });
        });

         $("#btnGuardarTarifasGuia").click(function () {
            //alert("mmm");
            $("#frmRegTarifasGuias").validate({
                rules: {
                    'idtarifa[]': {
                        required: true
                    },
                    iddestinatario: {
                        required: true,
                        comboBox: '-'
                    },
                    tipo_tarifa: {
                        required: true,
                        comboBox: '-'
                    },
                },
                messages: {
                    'idtarifa[]': {required: "Debe seleccionar una opcion"
                    },
                    iddestinatario: {required: "Debe seleccionar un destinatario",
                    comboBox: "Debe seleccionar un destinatario"
                    },
                    tipo_tarifa: {required: "Debe seleccionar un tipo de tarifa",
                    comboBox: "Debe seleccionar un tipo de tarifa"
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
                    form.submit();
                    $.ajax({
                        type: "POST",
                        url: base_url + "login/validar",
                        data: $("#frmRegTarifasGuias").serialize(),
                        dataType: "html",
                        cache: false,
                        success: function (data) {
                            //alert(url);
                            $("#agregarEmpresa").dialog('close');
                        }
                    });
                }
            });
        });

        $("#btnRegistrarGuias").click(function () {
            //alert("mmm");
            $("#frmRegistrarGuia").validate({
                rules: {
                    tipo_tarifa: {
                        required: true,
                        comboBox: '-'
                    },
                    formaPago: {
                        required: true,
                        comboBox: '-'
                    },
                    txtFecRecogida: {
                        required: true
                    },
                    iddestinatario: {
                        required: true,
                        comboBox: '-'
                    },
                    idmpioDest: {
                        required: true,
                        comboBox: '-',
                        expresion: '(parseInt($("#iddestinatario").val()) > parseInt($("#idmpioDest").val())) || (parseInt($("#iddestinatario").val()) < parseInt($("#idmpioDest").val()))'
                    },
                    /*idtarifa: {
                        required: true
                    },*/

                },
                messages: {
                    tipo_tarifa: {required: "Debe seleccionar un tipod e tarifa",
                    comboBox: "Debe seleccionar un tipo de tarifa"
                    },
                    formaPago: {required: "Debe seleccionar una forma de pago",
                    comboBox: "Debe seleccionar una forma de pago"
                    },
                    txtFecRecogida:{  required: "debe ingresar la feche de recogida"
                    },
                    iddestinatario: {required: "Debe seleccionar un destinatario",
                    comboBox: "Debe seleccionar seleccionar un destinatario"
                    },
                    idmpioDest: {required: "Debe seleccionar la ciudad de destinatario",
                    comboBox: "Debe seleccionar seleccionar un destinatario",
                    expresion: "La ciudad destino no corresponde con destinatario"
                    },
                    /*idtarifa: {required: "Debe escoger un sector obligatoriamente."
                    },*/

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
                    if(!$("input.tarifa:checked[type=checkbox]").length>0){ 
                        alert("Debe seleccionar al menos una tarifa y cantidad");
                         event.preventDefault();
                    }else{
                        form.submit();  
                        $.ajax({
                            type: "POST",
                            url: base_url + "guias/registrarGuia",
                            data: $("#frmRegistrarGuia").serialize(),
                            dataType: "html",
                            cache: false,
                            success: function (data) {
                                alert(url);
                                $("#agregarEmpresa").dialog('close');
                            }
                        });
                    }
                }
            });
        });

        $("#btnGuardarTarifasGuia").click(function () {
            //alert("mmm");
            $("#frmRegTarifasGuias").validate({
                rules: {
                    tipo_tarifa: {
                        required: true,
                        comboBox: '-'
                    },
                    formaPago: {
                        required: true,
                        comboBox: '-'
                    },
                    txtFecRecogida: {
                        required: true
                    },
                    iddestinatario: {
                        required: true,
                        comboBox: '-'
                    },
                    idmpioDest: {
                        required: true,
                        comboBox: '-',
                        expresion: '(parseInt($("#iddestinatario").val()) > parseInt($("#idmpioDest").val())) || (parseInt($("#iddestinatario").val()) < parseInt($("#idmpioDest").val()))'
                    },
                    /*idtarifa: {
                        required: true
                    },*/

                },
                messages: {
                    tipo_tarifa: {required: "Debe seleccionar un tipod e tarifa",
                    comboBox: "Debe seleccionar un tipo de tarifa"
                    },
                    formaPago: {required: "Debe seleccionar una forma de pago",
                    comboBox: "Debe seleccionar una forma de pago"
                    },
                    txtFecRecogida:{  required: "debe ingresar la feche de recogida"
                    },
                    iddestinatario: {required: "Debe seleccionar un destinatario",
                    comboBox: "Debe seleccionar seleccionar un destinatario"
                    },
                    idmpioDest: {required: "Debe seleccionar la ciudad de destinatario",
                    comboBox: "Debe seleccionar seleccionar un destinatario",
                    expresion: "La ciudad destino no corresponde con destinatario"
                    },
                    /*idtarifa: {required: "Debe escoger un sector obligatoriamente."
                    },*/

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
                    if(!$("input.tarifa:checked[type=checkbox]").length>0){ 
                        alert("Debe seleccionar al menos una tarifa y cantidad");
                         event.preventDefault();
                    }else{
                        form.submit();  
                        $.ajax({
                            type: "POST",
                            url: base_url + "guias/registrarGuia",
                            data: $("#frmRegTarifasGuias").serialize(),
                            dataType: "html",
                            cache: false,
                            success: function (data) {
                                alert(url);
                                $("#agregarEmpresa").dialog('close');
                            }
                        });
                    }
                }
            });
        });
        /*$("#idestablecimiento").change(function () {
            $("#idestablecimiento option:selected").each(function () {
                var idestablecimiento=$(this).val();
                //alert (idestablecimiento);
                 $.ajax({
                    type: "POST",
                    url: base_url + "guias/obtenerGuiaCliente",
                    data: {'idestablecimiento': $("#idestablecimiento").val(), 'form': $(frmRegistrarGuia).serialize()},
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        $("#datosGuias").html(data);
                    }
                });
               
            });
        })*/

         $("#tipo_tarifa").change(function () {
            $("#tipo_tarifa option:selected").each(function () {
                var tipoTarifa=$(this).val();
                //alert (tipoTarifa);
                if(tipoTarifa=='1'){
                   // $("#formularioRubros").css("display", "block");
                    //$(".valor_tarifa").hide();
                    $(".normal").hide();
                    //$("#formularioAplicara").hide();
                }else{
                    //$("#formularioRubros").css("display", "none");
                    //$(".valor_tarifa").show();
                    $(".normal").show();
                    //$("#formularioAplicara").show();
                 }
                if(tipoTarifa=='2'){
                    // $("#formularioRubros").css("display", "block");
                    $(".referencia").hide();
                }else{
                    $(".referencia").show();
                }
            });
        });

    
     $(".tarifa").change(function () { 
        var idtar=$(this).val();
        if($(this).prop('checked')){
            $("#cantidad"+idtar).prop("disabled", false); 
            $("#valor_tarifa"+idtar).prop("disabled", false); 
            $("#valor_minima"+idtar).prop("disabled", false); 
            //alert("Seleccionado el input " + $(this).val());
        }else{

            $("#cantidad"+idtar).prop("disabled", true); 
            $("#valor_tarifa"+idtar).prop("disabled", true); 
            $("#valor_minima"+idtar).prop("disabled", true); 
            $("#cantidad"+idtar).val('');
            $("#valor"+idtar).val('');
        }    
    });  
         


    }); 
});


