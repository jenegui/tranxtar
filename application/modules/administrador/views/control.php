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
	<div class="fivecol"><h1>&nbsp; &nbsp;  &nbsp;Control Guias</h1></div>
	<div style="text-align: right;" class="sixcol">
	  <?php 
                if($usuario==6){
                    $campo1="Estado contable";
                    $campo2="Estado Recaudo";
                }else{
                    $campo1="Imprimir";
                    $campo2="Fecha registro";
                }
                if($usuario==4 || $usuario==6){ 
                    echo "";
                }else{ ?>
              <input type="button" id="btnAgregaGuiar" name="btnAgregarGuia" value="Registar guia" class="button"/>
          <?php } 
          ?>
	</div>
</div>
<br/>
<div id="divDirectorio">
<table id="tablaControl" width="100%" style="font-size: 11px;">
<thead>
<tr>
  <th>N.Guia</th>
  <th>ID cliente</th>
  <th>Nombre cliente</th>
  <th>Fecha recogida</th>
  <th>Fecha entrega</th>
  <th>ID destinatario</th>
  <th>Nombre destinatario</th>
  <th>Valor flete</th>
  <th><?php echo $campo2; ?> </th>
  <th>Estado de la carga</th>
  <th>Editar</th>
  <th><?php echo $campo1; ?> </th>
</thead>
<tbody>
<?php 
for ($i=0; $i<count($control); $i++){ 
    $class = (($i%2)==0)?"row1":"row2";
    $tipoEncuesta="Encuesta";
    //$url=base_url("administrador/mostrarFormulario/".$fuentes[$i]["nro_establecimiento"]);
    
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
<div id="agregarGuia" style="display: none">
<?php 
	//Preparo array para terminar de enviarlo como parametro a la vista AJAX
        $this->load->model("establecimiento");
        $this->load->model("usuario");
        $this->load->model("estado");
        $data["establecimiento"] = $this->establecimiento->obtenerEstablecimientos();
        $data["destinatario"] = $this->usuario->obtenerDestinatarios();
        $data["operarios"] = $this->usuario->obtenerOperariosInternos();
        $data["operariosExt"] = $this->usuario->obtenerOperariosExternos();
        $data["estadocarga"] = $this->estado->estadoCarga();
        $data["tipodocs"] = $tipodocs;
	$data["departamentos"] = $departamentos;
	$data["municipios"] = $municipios;
        $data["ultimoEstab"]=$NoEstab;
        $data["usuario"]=$this->session->userdata("tipo_usuario");
	$this->load->view("ajxguiaadd",$data);
?>
</div>
<!-- Div para remover fuentes -->
<!--div id="removerFuente">
<?php /*
	$data["fuentes"] = $fuentes;
	$this->load->view("ajxfuentesdel",$data);*/ 
?>
</div -->
