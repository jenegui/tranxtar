$(function () {
     //Validador para actualizar los datos de la fuente
    $("#btnActualizarFuente").click(function () {
        $("#frmEditarFuente").validate({
            rules: {
                idnomcomest: {required: true},
                idnitest: {required: true},
                iddireccest: {required: true},
                idtelnoest: {required: true},
                idtelno: {required: true},
                idcorreoest: {required: true,
                    email: true
                },
                cmbDeptoEst: {comboBox: '-'},
                cmbMpioEmp: {cmbMpioEst: '-'},
                nom_contacto: {required: true},
                iddireccest: {required: true},
                idtelnoest: {required: true},
                idcorreoest: {required: true,
                    email: true
                },
                estado_establecimiento: {comboBox: '-'},
                cmbDeptoEst: {comboBox: '-'},
                cmbMpioEst: {comboBox: '-'},
                cmbSedeEst: {comboBox: '-'},
                cmbSubSedeEst: {comboBox: '-'}
            },
            messages: {
                idnomcomest: {required: "Debe ingresar nombre de la empresa."},
                idnitest: {required: "Debe ingresar el n&uacute;mero de identidicacion."},
                iddireccest: {required: "Debe ingresar la direcci&oacute;n."},
                idtelnoest: {required: "Debe ingresar el n&uacute;mero telef&oacute;nico."},
                idtelno: {required: "Debe ingresar el n&uacute;mero telef&oacute;nico de la empresa."},
                idcorreoest: {required: "Debe ingresar el correo electr&oacute;nico de la empresa.",
                    email: "No es un correo v&aacute;lido."},
                cmbDeptoEst: {required: "Debe seleccionar el departamento de la empresa."},
                cmbMpioEst: {required: "Debe seleccionar el municipio de la empresa."},
                nom_contacto: {required: "Debe ingresar el nombre del contacto."},
                iddireccest: {required: "Debe ingresar la direcci&oacute;n del establecimiento."},
                idtelnoest: {required: "Debe ingresar el n&uacute;mero telef&oacute;nico del establecimiento."},
                idcorreoest: {required: "Debe ingresar el correo electr&oacute;nico del establecimiento.",
                    email: "No es un correo v&aacute;lido."
                },
                estado_establecimiento: {required: "Debe seleccionar el estado."},
                cmbDeptoEst: {required: "Debe seleccionar el departamento del establecimiento."},
                cmbMpioEst: {required: "Debe seleccionar el municipio del establecimiento."},
                cmbSedeEst: {required: "Debe seleccionar la sede del establecimiento."},
                cmbSubSedeEst: {required: "Debe seleccionar la subsede del establecimiento."}
            },
            errorPlacement: function (error, element) {
                element.after(error);
                error.css('display', 'inline');
                error.css('margin-left', '10px');
                error.css('color', "#FF0000");
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

});

