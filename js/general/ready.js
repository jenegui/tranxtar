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


