<?php $this->load->library("session");
	  $this->load->helper("url");	
         
?>

<div id="menu" class="row">
	<div class="twelvecol last">
		<ul>
                    	
                         <?php if($this->session->userdata('tipo_usuario')==9){ ?>
                            <!--li><a href="<?php //echo site_url("administrador/directorio"); ?>">Clientes</a></li-->
                            <li><a href="<?php echo site_url("logistica/control"); ?>">Control Guias</a></li>
                            <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li> 
                            <li><a href="<?php echo site_url("logistica/cerrarSesion"); ?>">Salir&nbsp;</a></li>
                        <?php } ?> 
                           
                </ul>
	</div>	
</div>
