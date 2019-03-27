<div id="content">
	<h1>M&oacute;dulo de supervisor</h1>
	<p>Haga click en el men&uacute; superior para ingresar a la secci&oacute;n que requiera.</p>
</div>
<?php
echo "<div class='alert alert-danger' role='alert'>Estimado usuario supervisor, tiene ".$noAprobadas['estado']." guias pendientes para aprobar, ingrese a <a href='".site_url("administrador/control")."'> administrador/control  </a> en la opci&oacute;n editar para realizar la aprobaci&oacute;n.</div>";
?>