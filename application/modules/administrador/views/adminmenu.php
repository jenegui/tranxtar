<?php $this->load->library("session");
	  $this->load->helper("url");	
	  $periodo = $this->session->userdata('ano_periodo') . $this->session->userdata('mes_periodo');
         
?>

<form id="frmPeriodo" name="frmPeriodo" method="post" action="<?php echo site_url("administrador/actualizarPeriodo"); ?>">
<div id="menu" class="row">
	<div class="twelvecol last">
		<ul>
                    	<?php if($this->session->userdata('tipo_usuario')==1){ ?>
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
                        <?php } ?>
                        <?php if($this->session->userdata('tipo_usuario')==2){ ?>
                            <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>
                            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                            <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
                            <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
                        <?php } ?>
                        <?php if($this->session->userdata('tipo_usuario')==3){ ?>
                            <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>
                            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                            <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
                        <?php } ?>
                        <?php if($this->session->userdata('tipo_usuario')==5){ ?>
                            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                            <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
                        <?php } ?>
                         <?php if($this->session->userdata('tipo_usuario')==4){ ?>
                            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
                        <?php } ?> 
                         <?php if($this->session->userdata('tipo_usuario')==6){ ?>
                            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;<img src="<?php echo base_url("images/exit.png"); ?>" title="Salir de la aplicaci&oacute;n" border="0"/></a></li>
                        <?php } ?>     
                </ul>
	</div>	
</div>
</form>