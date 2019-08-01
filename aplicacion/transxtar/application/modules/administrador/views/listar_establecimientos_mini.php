<?php
$this->load->library("general");
$style = 'style="color: #FF0000; font-weight: bold;"';
if(count($lista_estab)<=0){
	echo '<div style="color:#FF0000;" align="center">No hay establecimientos pendientes por asignaci&oacute;n usuarios miniencuesta!!!</div>';
}
else{
	?>
		<?php	$style = 'style="color: #FF0000; font-weight: bold;"'; ?>
		<div style="color:#FF0000;" align="center"><h1>Generar usuarios a los siguientes establecimientos</h1></div>
		<div id="reporteOPCritico">
		<form id="frmGenerarUsuariosEstMini" name="frmGenerarUsuariosEstMini" method="post" action="">
		<table width="100%" class="table" style="font-size: 11px;">
		<thead>
		<tr>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Nro de Orden</th>
		   <th style="border-right: 1px solid #CCCCCC;" align="center">Nro de Establecimiento</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Nombre empresa</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Direcci&oacute;n</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Generar</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		if(count($lista_estab)>700){
                    $cuenta=700;
                }else{
                    $cuenta=count($lista_estab);
                }
		for ($i=0; $i<$cuenta; $i++){
		  	  	$var = ($i%2!=0)?"row2":"row1";
				$html='<tr class="'.$var.'">';
				$html.='<td align="center">'.$lista_estab[$i]["nro_orden"].'</td>';
				$html.='<td align="center">'.$lista_estab[$i]["nro_establecimiento"].'</td>';
		  		$html.='<td align="center">'.$lista_estab[$i]["idnomcom"].'</td>';
		  		$html.='<td align="center">'.$lista_estab[$i]["iddirecc"].'</td>';
		  		$html.='<td align="center"><input type="checkbox" id="establecimiento'.$i.'" name="establecimiento'.$i.'" value="'.$lista_estab[$i]["nro_establecimiento"].'" checked=""/></td>';
		  		
		  	$html.='</tr>';
		  	echo $html;
		}
		?>	
		</tbody>
		</table>
		<br>	
		<div><input type="hidden" id="generaUsuEstabMini" name="generaUsuEstabMini" value=""/></div>
		<div align="center"><input type="button" id="btnGenerarUsuariosEstMini" name="btnGenerarUsuariosEstMini" value="GenerarUsuarios" class="button"/></div>
		<!-- input type="button" id="btnBuscarASTT" name="btnBuscarASTT" value="Buscar" class="button"/-->	 
	
	</form>
		<br/>
		</div>
		
	<?php 
	} 
?>