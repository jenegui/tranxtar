<?php $this->load->library("session");
	  $this->load->helper("url");	
	  $periodo = $this->session->userdata('ano_periodo') . $this->session->userdata('mes_periodo');
         
?>

<div id="menu" class="row">
	<div class="twelvecol last">
		<ul>
                    	
                         <?php if($this->session->userdata('tipo_usuario')==4){ ?>
                            <!--li><a href="<?php //echo site_url("administrador/directorio"); ?>">Clientes</a></li-->
                            <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                            <li><a href="<?php echo site_url("traficoseguridad/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li> 
                            <li><a href="<?php echo site_url("traficoseguridad/cerrarSesion"); ?>">Salir&nbsp;</a></li>
                        <?php } ?> 
                           
                </ul>
	</div>	
</div>
