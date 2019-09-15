<?php
$this->load->library("session");
$this->load->helper("url");
$periodo = $this->session->userdata('ano_periodo') . $this->session->userdata('mes_periodo');
?>

<div id="menu" class="row">
    <div class="twelvecol last">
        <ul>
            <li><a href="<?php echo site_url("cliente/editarFuente"); ?>">Editar informaci&oacute;n</a></li>
            <li><a href="<?php echo site_url("administrador/destinatarios"); ?>">Destinatarios</a></li>
            <li><a href="<?php echo site_url("administrador/control"); ?>">Control Guias</a></li>
            <li><a href="<?php echo site_url("cliente/cerrarSesion"); ?>">Salir&nbsp;</a></li>
        </ul>
    </div>	
</div>