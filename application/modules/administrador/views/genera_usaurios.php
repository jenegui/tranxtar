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
<div class="row">
	<div class="fivecol"><h1>Generar usuarios empresar y establecimientos</h1></div>
	<br>
	<div style="text-align: right;" class="elevencol">
	    <input type="button" id="btnAperEst" name="btnAperEst" value="Aperturas estab." class="button"/>
	    <input type="button" id="btnCieEst" name="btnCieEst" value="Cierres estab." class="button"/>
		<input type="button" id="btnUsuEstab" name="btnUsuEstab" value="Generar usuarios estab." class="button"/>
	  	<input type="button" id="btnUSuEmp" name="btnUSuEmp" value="Generar usuarios empresas" class="button"/>
                <input type="button" id="btnUsuEstabMini" name="btnUsuEstabMini" value="Generar usuarios miniencuesta" class="button"/>
	</div>
</div>
<br/>



<!-- Div para ageragr empresas -->
<div id="agregarEmpresa">
<?php 
	$data["departamentos"] = $departamentos;
	$data["municipios"] = $municipios;
	$this->load->view("empresa_agregar",$data); 
?>
</div>



<!-- Div para generar usuarios establecimientos -->
<div id="generarUsuarioEstab" style="display: none">
<?php 
	$this->load->model("establecimiento");
	$data["lista_estab"] = $this->establecimiento->obtenerEstablecimientos();
	$this->load->view("listar_establecimientos",$data);
?>
</div>

<!-- Div para generar usuarios establecimientos -->
<div id="generarUsuarioEstabMini" style="display: none">
<?php 
	$this->load->model("establecimiento");
	$data["lista_estab"] = $this->establecimiento->obtenerEstablecimientos();
	$this->load->view("listar_establecimientos_mini",$data);
?>
</div>

<!-- Div para generar usuarios empresas -->
<div id="generarUsuarioEmpresa" style="display: none">
<?php 
	$this->load->model("empresa");
	$data["lista_empresas"] = $this->empresa->obtenerEmpresas();
	$this->load->view("listar_empresas",$data); 
?>
</div>


<!-- Div para generar usuarios empresas -->
<div id="adminEstablecimientos" style="display: none">
<?php 
	$this->load->model("sede");
	$this->load->model("subsede");
	$data["sedes"] = $this->sede->obtenerSedes();
	$data["subsedes"] = $this->subsede->obtenerSubSedes();
	$this->load->model("establecimiento");  
	$data["lista_estab"] = $this->establecimiento->obtenerEstablecimientosCreados();
	$this->load->view("listar_establecimientos_creados",$data); 
	//$this->load->view("layout",$data);
?>
</div>

<div id="adminEstablecimientos1" style="display: none">
<?php 
	$this->load->model("sede");
	$this->load->model("subsede");
	$this->load->model("establecimiento"); 
        $ano_periodo=$this->session->userdata("ano_periodo");
        $mes_periodo= $this->session->userdata("mes_periodo");
	$data["lista_estab"] = $this->establecimiento->obtenerEstablecimientosCerrados($ano_periodo,$mes_periodo);
	$this->load->view("listar_establecimientos_cerrados",$data); 
	//$this->load->view("layout",$data);
?>
</div>