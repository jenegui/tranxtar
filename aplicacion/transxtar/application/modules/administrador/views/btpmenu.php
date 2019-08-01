<!-- Bootstrap CSS, funcional cores originales usados en el template-->
<link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap  JavaScript, funcional cores usados en el template -->
<script src="/vendor/jquery/jquery.min.js"></script> 
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="/vendor/jquery-easing/jquery.easing.min.js"></script> 


<!-- opcion 
-->


<?php
$this->load->library( "session" );
$this->load->helper( "url" );
$periodo = $this->session->userdata( 'ano_periodo' ) . $this->session->userdata( 'mes_periodo' );

?>





<div id="menu" class="row">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  	</button>


	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			
		<?php if($this->session->userdata('tipo_usuario')==1){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/directorio "); ?>">Clientes</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/usuarios "); ?>">Usuarios</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/destinatarios "); ?>">Destinatarios</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/Operarios "); ?>">Operarios Externos</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/reportexCiudad "); ?>">Reporte por ciudad</a>
		</li>
		<!--li><a class="nav-link" href="<?php echo site_url("moduloanalisis/moduloanalisis"); ?>">Mod. An&aacute;lisis</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("administrador/cierreperiodo");?>">Cierre de periodo</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("administrador/descarga"); ?>">Formulario&nbsp;<img src="<?php echo base_url("images/acrobat.png"); ?>" title="Formulario en Blanco" border="0"/></a></li-->
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>
		<?php if($this->session->userdata('tipo_usuario')==2){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/directorio "); ?>">Clientes</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/destinatarios "); ?>">Destinatarios</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/Operarios "); ?>">Operarios Externos</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>
		<?php if($this->session->userdata('tipo_usuario')==3){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/directorio "); ?>">Clientes</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/destinatarios "); ?>">Destinatarios</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>
		<?php if($this->session->userdata('tipo_usuario')==5){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/destinatarios "); ?>">Destinatarios</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>
		<?php if($this->session->userdata('tipo_usuario')==4){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>
		<?php if($this->session->userdata('tipo_usuario')==6){ ?>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/control "); ?>">Control Guias</a>
		</li>
		<li class="nav-item"><a class="nav-link" href="<?php echo site_url(" administrador/cerrarSesion "); ?>">Salir&nbsp;</a>
		</li>
		<?php } ?>

		</ul>

	</div>
</nav>


</div>
</div>