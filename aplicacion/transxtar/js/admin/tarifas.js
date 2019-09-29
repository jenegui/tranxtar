jQuery(function () {
    $(function () {
        $('.tablesorter').tablesorter({
        theme: "green",
                checkboxClass: 'checked', // default setting
                widthFixed: true,
                headerTemplate : '{content} {icon}',
                widgets: ["zebra", "stickyHeaders", "filter", "uitheme", "output"],
                usNumberFormat: false,
                sortReset: true,
                sortRestart: true

        });

        $.validator.addMethod("comboBox", function (value, element, param) {
            var idx = (param).toString();
            if ($(element).val() == idx)
                return false;
            else
                return true;
        }, "")

        $("#valor_tarifa").numerico().largo(8);
        $("#factor_conversion").numerico().largo(8);
        $("#valor_minima").numerico().largo(8);
        $("#valor_minima").numerico().largo(8);
        $("#ancho").numerico().largo(8);
        $("#alto").numerico().largo(8);
        $("#largo").numerico().largo(8);
        
        $("#cmbDeptoTar").select2();
        $("#cmbMpioTar").select2();
        $("#cmbDeptoTar").cargarCombo("cmbMpioTar", "administrador/actualizarMunicipios");

        jQuery("#frmRegTarifas").validate({
                rules: {
                cmbDeptoTar: {
                    comboBox: '-'
                },
                cmbMpioTar: {
                    comboBox: '-'
                },
                tipo_tarifa: {
                    comboBox: '-'
                },
                valor_tarifa: {
                    required: true
                },
                valor_minima: {
                    required: true
                },
                peso: {
                    required: true
                },
                largo: {
                    required: true
                },
                alto: {
                    required: true
                },
                ancho: {
                    required: true
                },
                costomanejo: {
                    required: true
                },
                referencia: {
                    required: true
                }
            },
            messages: {
                cmbDeptoTar: {
                    comboBox: "Seleccione una departamento."
                },
                cmbMpioTar: {
                    comboBox: "Seleccione un municipio."
                },
                 tipo_tarifa: {
                    comboBox: "Seleccione tipo de tarifa."
                },
                valor_tarifa: {
                    required: "El campo valor tarifa es obligatorio."
                },
                valor_minima: {
                    required: "El campo valor minima es obligatorio."
                },
                peso: {
                    required: "El campo peso es obligatorio."
                },
                largo: {
                    required: "El campo largo es obligatorio."
                },
                ancho: {
                    required: "El campo largo es obligatorio."
                },
                alto: {
                    required: "El campo alto es obligatorio."
                },
                costomanejo: {
                    required: "El campo costo de manejo es obligatorio."
                },
                referencia: {
                    required: "El campo referencia obligatorio."
                }
            },
            errorPlacement: function (error, element) {
                element.after(error);
                error.css('opacity', '0.47');
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
            }
        });
        $("#tipo_tarifa").change(function () {
           	$("#tipo_tarifa option:selected").each(function () {
	            var tipoTarifa=$(this).val();
	            //alert (tipoTarifa);
	            if(tipoTarifa=='1'){
	               // $("#formularioRubros").css("display", "block");
	                //$(".valor_tarifa").hide();
	                $(".factor_conversion").hide();
	                //$("#formularioAplicara").hide();
	            }else{
	                //$("#formularioRubros").css("display", "none");
	                //$(".valor_tarifa").show();
	                $(".factor_conversion").show();
	                //$("#formularioAplicara").show();
	             }
	            if(tipoTarifa=='2'){
	            	// $("#formularioRubros").css("display", "block");
	                $(".referencia").hide();
	            }else{
	            	$(".referencia").show();
	            }
        	});
   		})

    }); 
});