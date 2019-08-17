$(function () {
//Valida el env�o del formulario de agregar empresas
    $("#btnIngresar").click(function () {
        $("#frmIngresar").validate({
            rules: {
                txtLogin: {required: true},
                txtPassword: {required: true}
            },
            messages: {
                txtLogin: {required: "Debe ingresar usuario."},
                txtPassword: {required: "Debe ingresar password."},
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
                /*$.ajax({
                    type: "POST",
                    url: base_url + "login/validar",
                    data: $("#frmIngresar").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        //alert(url);
                        $("#agregarEmpresa").dialog('close');
                    }
                });*/
            }
        });
    });

//Valida el env�o del formulario de agregar empresas
$("#numGuia").numerico().largo(20);
    $("#seguimiento").click(function () {
        $("#numeroguia").validate({
            rules: {
                numGuia: {required: true},
                txtPassword: {required: true}
            },
            messages: {
                numGuia: {required: "Debe ingresar el n&uacute;mero de la gu&iacute;a."},
                txtPassword: {required: "Debe ingresar password."},
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
                /*$.ajax({
                    type: "POST",
                    url: base_url + "login/validar",
                    data: $("#frmIngresar").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        //alert(url);
                        $("#agregarEmpresa").dialog('close');
                    }
                });*/
            }
        });
    });

    $("#cmbDeptoEstab").cargarCombo("cmbMpioEstab", "login/actualizarMunicipios");
    $("#pesoKg").numerico().largo(5);
    $("#cantidad").numerico().largo(5);
    $("#alto").numerico().largo(5);
    $("#ancho").numerico().largo(5);
    $("#profundo").numerico().largo(5);
    $("#btnCotizar").click(function () {
        $("#formCotizar").validate({
            rules: {
                cmbDeptoEstab: {required: true,
                    comboBox: '-'
                },
                cmbMpioEstab: {required: true,
                    comboBox: '-'
                },
                pesoKg: {
                    required: true
                    //menorQue: 30
                },
                cantidad: {
                    required: true
                },
                alto: {
                    required: true
                },
                ancho:{
                    required: true 
                },
                largo:{
                    required: true
                },
                valdeclarado: {
                    required: true,
                    menorQue: 300000
                }
                
            },
            messages: {
               cmbDeptoEstab: {required: "Debe seleccionar un departamento",
                    comboBox: "Debe seleccionar un departamento."
                },
                cmbMpioEstab: {required: "Debe seleccionar una ciudad",
                    comboBox: "Debe seleccionar una ciudad"
                },
                pesoKg : {
                    required: "Debe digitar el peso en Kgs."
                    //menorQue: "El peso mínimo de de 30 kg."
                },
                cantidad: {
                    required: "Debe digitar la cantidad."
                },
                alto: {
                    required: "Debe digitar el alto de la carga."
                },
                ancho: {
                    required: "Debe digitar el ancho de la carga."
                },
                largo: {
                    required: "Debe digirtar el largo de la carga."
                },
                valdeclarado: {
                    required: "Digite el valor declarado de la carga.",
                    menorQue: "El valor declarado no puede ser menor a $300.000"
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
                /*$.ajax({
                    type: "POST",
                    url: base_url + "login/validar",
                    data: $("#frmIngresar").serialize(),
                    dataType: "html",
                    cache: false,
                    success: function (data) {
                        //alert(url);
                        $("#agregarEmpresa").dialog('close');
                    }
                });*/
            }
        });
    });

    $("#idestablecimiento").select2();
    $("#evento").select2();
    $("#anio").select2();



    $('#fechaIni').datepicker({
    //$('#fechaIni'+ i).datepicker({    
            dateFormat: 'mm/dd/yy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
            });
    $('#fechaFin').datepicker({
            dateFormat: 'mm/dd/yy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
            dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa']
            });
});
$(function() {
    $( "button" )
    .button()
    .click(function( event ) {
        event.preventDefault();
    });
});



//Asociar el widget tabs a la división cuyo id es tabs
$(function() {
    $( "#tabs" ).tabs();
});




