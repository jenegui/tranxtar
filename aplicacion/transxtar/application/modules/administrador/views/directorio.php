<style>
	.links strong{
		color: #F00;
	}
	
	
	.links a:link {
		padding: 2px 2px 2px 2px;
		text-align: center;
		text-decoration: none;
		font-size: 12px;
		color: #000;
		background: #FFFFFF;
	}
	
	.links a:visited {
		/*border: 1px solid #F00;*/
		padding: 2px 2px 2px 2px;
		text-align: center;
		text-decoration:none;
		font-size: 12px; 
		color:#000;
	} 
	
	.links a:hover {
		border: 1px solid #000;
		padding: 2px 2px 2px 2px;
		text-decoration:underline;
		font-weight: bolder; 
		color:#F00; 
		background: #EEEEEE;
	}
</style>
<br/>
<form id="frmDir" name="frmDir" method="post" action="<?php echo site_url("administrador/descargadirectorio"); ?>"></form>
<div class="row">
	<div class="fivecol"><h1>&nbsp; &nbsp;  &nbsp;Directorio de Clientes</h1></div>
	<div style="text-align: right;" class="sixcol">
	  <?php 
	  		//if (($ano_periodo == $reciente["ano"])&&($mes_periodo == $reciente["mes"])){ ?>
	  			<input type="button" id="btnAgregar" name="btnAgregar" value="Agregar clientes" class="button"/>
                                <!--a href="<?php //echo site_url("administrador/registrarClientes"); ?>">Registrar Clientes</a-->
	  			
	  <?php //} ?>
	</div>
</div>
<br/>
<div id="divDirectorio" class="table-responsive">
<table id="tablaDirectorio" width="100%" style="font-size: 11px;" class="table">
<thead>
<tr>
  <th>N.Establ</th>
  <th>Nombre Establ</th>
  <th>Id establ</th>
  <th>Direcci&oacute;n</th>
  <th>Tel&eacute;fono</th>
  <th>Correo electr&oacute;nico</th>
  <th>Contacto</th>
  <th>Depto</th>
  <th>Municipio</th>
  <th>Comercial</th>
  <th>Estado</th>
  <th>Editar</th>
</tr>
</thead>
<tbody>
<?php 
for ($i=0; $i<count($fuentes); $i++){ 
    $class = (($i%2)==0)?"row1":"row2";
?>
<tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
</tr>
<?php } ?>
<tr>
</tr>
</tbody>

</table>
</div>


<!-- Div para ageragr empresas -->
<div id="editarCliente" style="display: none">
<?php 
        $data["tipodocs"] = $tipodocs;
	$data["departamentos"] = $departamentos;
	$data["municipios"] = $municipios;
        $data["ultimoEstab"]=$NoEstab;
	$this->load->view("consultarfte",$data);
?>
</div>



<!-- Div para agregar establecimientos -->
<div id="agregarFuente" style="display: none">
<?php 
	//Preparo array para terminar de enviarlo como parametro a la vista AJAX
	$data["tipodocs"] = $tipodocs;
	$data["departamentos"] = $departamentos;
	$data["municipios"] = $municipios;
        $data["ultimoEstab"]=$NoEstab;
        $data["comerciales"]=$comerciales;
        $data["id_usuario"]=$id_usuario;
	$this->load->view("ajxfuentesadd",$data);
?>
</div>
<!-- Div para remover fuentes -->
<!--div id="removerFuente">
<?php /*
	$data["fuentes"] = $fuentes;
	$this->load->view("ajxfuentesdel",$data);*/ 
?>
</div -->
