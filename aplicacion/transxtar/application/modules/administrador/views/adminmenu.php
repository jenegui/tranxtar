<?php
$this->load->library("session");
$this->load->helper("url");
$periodo = $this->session->userdata('ano_periodo') . $this->session->userdata('mes_periodo');
?>






<div id="menu" class="row">
    <div class="twelvecol last">
        <ul>
            <?php if ($this->session->userdata('tipo_usuario') == 1) { ?>
                <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>			
                <li><a href="<?php echo site_url("administrador/usuarios"); ?>">Usuarios</a></li>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control de Guias</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
                <li><a href="<?php echo site_url("administrador/reportexCiudad"); ?>">Reporte por ciudad</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("runner"); ?>">Reportes</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?>
            <?php if ($this->session->userdata('tipo_usuario') == 2) { ?>
                <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?>
            <?php if ($this->session->userdata('tipo_usuario') == 3) { ?>
                <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?>
            <?php if ($this->session->userdata('tipo_usuario') == 5) { ?>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?>
            <?php if ($this->session->userdata('tipo_usuario') == 4) { ?>
                <!--li><a href="<?php //echo site_url("administrador/directorio");  ?>">Clientes</a></li-->
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("traficoseguridad/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?> 
            <?php if ($this->session->userdata('tipo_usuario') == 6) { ?>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?> 
            <?php if ($this->session->userdata('tipo_usuario') == 7) { ?>
                <li><a href="<?php echo site_url("administrador/directorio"); ?>">Clientes</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
                <li><a href="<?php echo site_url("administrador/Operarios"); ?>">Operarios Externos</a></li>
                <li><a href="<?php echo site_url("administrador/reporteHistorico"); ?>">Reporte hist&oacute;rico</a></li>
                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?>
            <?php if ($this->session->userdata('tipo_usuario') == 8) { ?>
                <li><a href="<?php echo site_url("cliente/editarFuente"); ?>">Editar informaci&oacute;n</a></li>
                <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
                <li><a href="<?php echo site_url("guias/guias"); ?>">Registrar Guias</a></li>
                <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>

                <li><a href="<?php echo site_url("administrador/cerrarSesion"); ?>">Salir&nbsp;</a></li>
            <?php } ?> 
        </ul>
    </div>	
</div>
