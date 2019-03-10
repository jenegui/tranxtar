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
	<div class="fivecol"><h1>Directorio de Clientes</h1></div>
	<div style="text-align: right;" class="sixcol">
	  <?php 
	  		//if (($ano_periodo == $reciente["ano"])&&($mes_periodo == $reciente["mes"])){ ?>
	  			<input type="button" id="btnAgregar" name="btnAgregar" value="Agregar clientes" class="button"/>
	  			<input type="button" id="btnEditar" name="btnEditar" value="Editar fuentes" class="button"/>
	  <?php //} ?>
	</div>
</div>
<br/>
<div id="divDirectorio">
<table id="tablaDirectorio" width="100%" style="font-size: 11px;">
<thead>
<tr>
  <th>N.Establ</th>
  <th>Nombre Establecimiento</th>
  <th>NIT</th>
  <th>Direcci&oacute;n</th>
  <th>Tel&eacute;fono</th>
  <th>Correo electr&oacute;nico</th>
  <th>Contacto</th>
  <th>Departamento</th>
  <th>Municipio</th>
  <th>Estado</th>
  <!--th>Opciones</th-->
</tr>
</thead>
<tbody>
<?php 
for ($i=0; $i<count($fuentes); $i++){ 
    $class = (($i%2)==0)?"row1":"row2";
    $tipoEncuesta="Encuesta";
    $url=base_url("administrador/mostrarFormulario/".$fuentes[$i]["nro_establecimiento"]);
    
?>
<tr>
 
  <!--td><a href="<?php //echo $url; ?>"><?php //echo $fuentes[$i]["nro_establecimiento"]; ?></a></td-->
    <td><?php //echo $fuentes[$i]["nro_establecimiento"]; ?></td> 
  <td><?php //echo $fuentes[$i]["idnomcom"]; ?></td>
  <td><?php echo $fuentes[$i]["nit_establecimiento"]; ?></td>
  <td><?php echo $fuentes[$i]["iddirecc"]; ?></td>
  <td><?php echo $fuentes[$i]["idtelno"]; ?></td>
  <td><?php echo $fuentes[$i]["idcorreo"]; ?></td>
  <td><?php echo $fuentes[$i]["nom_contacto"]; ?></td>
  <td><?php echo $fuentes[$i]["fk_depto"]; ?></td>
  <td><?php echo $fuentes[$i]["fk_mpio"]; ?></td>
  <td><?php echo $fuentes[$i]["estado"]; ?></td>
  <!--td align="center">
     <a href="<?php //echo site_url("administrador/editarFuente/".$fuentes[$i]["nro_establecimiento"].""); ?>"><img src="<?php //echo base_url("images/edit.png"); ?>"/></a>
     <a href="javascript:removerFuenteDirectorio(<?php echo $fuentes[$i]["nro_establecimiento"]; ?>);"><img src="<?php //echo base_url("images/delete.png"); ?>"/></a>
     <?php /*
     <a href="<?php echo site_url("administrador/eliminarFuente/".$fuentes[$i]["nro_orden"]."/".$fuentes[$i]["nro_establecimiento"].""); ?>"><img src="<?php echo base_url("images/delete.png"); ?>"/></a>
     */
     ?>
  </td-->
  
</tr>
<?php } ?>
<tr>
</tr>
</tbody>
<tfoot>
	<tr>
  		<td colspan="9">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" align="left">&nbsp;</td>
		<td colspan="6" align="right" class="links"><?php echo $links; ?></td>
	</tr>
</tfoot>
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
