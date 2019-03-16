<?php $this->load->library("session");
	  $this->load->helper("url");	
	  $periodo = $this->session->userdata('ano_periodo') . $this->session->userdata('mes_periodo');	  
?>

<form id="frmPeriodo" name="frmPeriodo" method="post" action="<?php echo site_url("administrador/actualizarPeriodo"); ?>">
<div id="menu" class="row">
	<div class="twelvecol last">
		<ul>
			<li>
			    <select id="cmbPeriodo" name="cmbPeriodo" class="select">
			    <option value="------">...</option>			    
			    <?php for ($i=0; $i<count($periodos); $i++){ 
			          	 if ($periodos[$i]["periodo"]==$periodo)
			          	 	echo '<option value="'.$periodos[$i]["periodo"].'" selected="selected">'.$periodos[$i]["nom_periodo"].'</option>';
			          	 else	
			          	 	echo '<option value="'.$periodos[$i]["periodo"].'">'.$periodos[$i]["nom_periodo"].'</option>';
			          } 
			    ?>
			    </select>			    
			</li>
			<li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>			
			<li><a href="<?php echo site_url("administrador/usuarios"); ?>">Usuarios</a></li>
			<li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                        <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
			<li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
			<!--li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Ind. Calidad</a></li>
			<li><a href="<?php echo site_url("moduloanalisis/moduloanalisis"); ?>">Mod. An&aacute;lisis</a></li>
			<li><a href="<?php echo site_url("administrador/cierreperiodo");?>">Cierre de periodo</a></li>
			<li><a href="<?php echo site_url("administrador/descarga"); ?>">Formulario&nbsp;<img src="<?php echo base_url("images/acrobat.png"); ?>" title="Formulario en Blanco" border="0"/></a></li-->
			<li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
		</ul>
	</div>	
</div>
</form>