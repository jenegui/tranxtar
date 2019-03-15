<script type="text/javascript">

$(function(){

	$("#txtNumId").numerico();
	$("#txtNomUsuario").mayusculas();
        $("#numplaca    ").mayusculas();
	$("#txtFecCreacion").datepicker();
	$("#txtFecVencimiento").datepicker();
	$("#cmbsede").cargarCombo("cmbSubsede","administrador/actualizarSubsedes");

	$("#frmINSoperario").validate({
		//Reglas de validacion
		rules: {
			cmbTipoDocumento: {	required: true,
				                comboBox: '-'
			},
			txtNumId: {	required: true
			},
			txtNomUsuario: { required: true
			},
			teloperario: { required: true
			},
			numplaca: { required: true
			},
			txtEmail: {	required: true,
				        email: true
			},
			txtFecCreacion: { required: true	
			},
			txtFecVencimiento: { required: true 
			},
			cmbRol: { required: true,
					  comboBox:'-'
            },
            cmbsede: {	required: true,
					    comboBox: '-'
            },
            cmbSubsede: { required: true,
					      comboBox: '-'
            }
		},
		messages: {
			cmbTipoDocumento: {	required : "Debe indicar el tipo de documento del usuario.",
				                comboBox : "Debe indicar el tipo de documento del usuario."
			},
			txtNumId: {	required: "Debe indicar el n&uacute;mero de documento del usuario."
			},
			txtNomUsuario: { required: "Debe indicar los nombres y apellidos del usuario."	
			},
			teloperario: { required: "Debe ingresar el n&uacute;mero de tel&eacute;fono."
			},
			numplaca: { required: "Debe ingresar el n&uacute;mero de placa del veh&iacute;culo."
			},
			txtEmail: {	required: "Debe ingresar el email del usuario.",
				        email: "No es un email v&aacute;lido."
			},
			txtFecCreacion: { required: "Debe ingresar la fecha de creaci&oacute;n del usuario."
			},
			txtFecVencimiento: { required: "Debe ingresar la fecha de vencimiento del usuario."	
			},
			cmbRol: { required: "Debe seleccionar el rol del usuario.",
				      comboBox: "Debe seleccionar el rol del usuario." 
			},
			cmbsede: { required: "Debe seleccionar la sede del usuario.",
				       comboBox: "Debe seleccionar la sede del usuario."
			},
			cmbSubsede: { required: "Debe seleccionar la subsede del usuario.",
				          comboBox: "Debe seleccionar la subsede del usuario."
			}
		},
		//Mensajes de error
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
		//Envio del formulario
		submitHandler: function(form) {
			
			//Valido que el numero de identificacion del usuario ni el login ya est�n registrados, 
			$.ajax({
				type: "POST",
				url: base_url + "administrador/validaOperario",
				data: {'tipodoc': $("#cmbTipoDocumento").val(),
					   'numdoc': $("#txtNumId").val()
				},
				dataType: "html", 
				cache: false,
				success: function(data){
					var test = eval("("+data+")");
                                        $("#errorNumID").css('display','inline');
					$("#errorNumID").css('margin-left','10px');				
					$("#errorNumID").css('color',"#FF0000");
                                        $("#errorNumID").html(test.error);
					if (test.valid!=false){
						form.submit();
						//location.reload();
					}			    										
				}
			});
		}
		
	});
});

</script>

<?php $this->load->helper("url"); ?>
   <br/>
   <form id="frmINSoperario" name="frmINSoperario" method="post" action="<?php echo site_url("administrador/insertarOperario"); ?>">
   <table width="100%">
   <tr>
     <td width="150">Tipo documento: </td>
     <td><select id="cmbTipoDocumento" name="cmbTipoDocumento" class="select">
     	 <option value="-">Seleccione el tipo de documento...</option>
         <?php for ($i=0; $i<count($tipodoc); $i++){
     	 	 		echo '<option value="'.$tipodoc[$i]["id"].'">'.$tipodoc[$i]["nombre"].'</option>';
     	 		}
     	 ?>
         </select>
     </td>
   </tr>
   <tr>
     <td>Num. Identificaci&oacute;n: </td>
     <td><input type="text" id="txtNumId" name="txtNumId" value="" class="textbox"/><div id="errorNumID"></div></td>
   </tr>
   <tr>
     <td>Nombre Operario: </td>
     <td><input type="text" id="txtNomUsuario" name="txtNomUsuario" value="" size="50" class="textbox"/></td>
   </tr>
   <tr>
     <td>Tel&eacute;fono Operario: </td>
     <td><input type="text" id="teloperario" name="teloperario" value="" class="textbox" maxlength="20"/></td>
   </tr>
   <tr>
     <td>No. de placa del veh&iacute;culo : </td>
     <td><input type="text" id="numplaca" name="numplaca" value="" class="textbox"/></td>
   </tr>
   <tr>
     <td>Fecha registro: </td>
     <td><input type="text" id="txtFecCreacion" name="txtFecCreacion" value="<?php echo date("d/m/Y"); ?>" class="textbox"/></td>
   </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="2"><input type="submit" id="btnOperarioADM" name="btnOperarioADM" value="Agregar" class="button"/></td>
   </tr>
   </table>
   </form>

