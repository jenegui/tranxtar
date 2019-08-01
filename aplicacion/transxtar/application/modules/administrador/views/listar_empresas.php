<?php
$this->load->library("general");
$style = 'style="color: #FF0000; font-weight: bold;"';
if(count($lista_empresas)<=0){
	echo '<div style="color:#FF0000;" align="center">No hay empresas pendientes por asignaci&oacute;n usuarios!!!</div>';
}
else{
	?>
		<?php	$style = 'style="color: #FF0000; font-weight: bold;"'; ?>
		<div style="color:#FF0000;" align="center"><h1>Generar usuarios a las siguientes empresas</h1></div>
		<div id="reporteOPCritico">
		<form id="frmGenerarUsuariosEst" name="frmGenerarUsuariosEst" method="post" action="">
		<table width="100%" class="table" style="font-size: 11px;">
		<thead>
		<tr>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Nro de Orden</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Nombre empresa</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Direcci&oacute;n</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Generar</th>
		</tr>
		</thead>
		<tbody>
		<?php
                if(count($lista_empresas)>700){
                    $cuenta=700; 
                }else{
                    $cuenta=count($lista_empresas);
                }
		for ($i=0; $i<$cuenta; $i++){
				//$calificacion=explode(",",$calific);
				$establecimiento=$lista_empresas[$i]["nro_orden"];
		  	  	$var = ($i%2!=0)?"row2":"row1";
				$html='<tr class="'.$var.'">';
				$html.='<td align="center">'.$lista_empresas[$i]["nro_orden"].'</td>';
		  		$html.='<td align="center">'.$lista_empresas[$i]["idproraz"].'</td>';
		  		$html.='<td align="center">'.$lista_empresas[$i]["iddirecc"].'</td>';
		  		$html.='<td align="center"><input type="checkbox" id="empresa'.$i.'" name="empresa'.$i.'" value="'.$lista_empresas[$i]["nro_orden"].'" checked=""/></td>';
		  		
		  	$html.='</tr>';
		  	echo $html;
		}
		?>	
		</tbody>
		</table>
		<br>	
		<div><input type="hidden" id="generaUsuEmp" name="generaUsuEmp" value=""/></div>
		<div align="center"><input type="button" id="btnGenerarUsuariosEst" name="btnGenerarUsuariosEst" value="GenerarUsuarios" class="button"/></div>
		<!-- input type="button" id="btnBuscarASTT" name="btnBuscarASTT" value="Buscar" class="button"/-->	 
	
	</form>
		<br/>
		</div>
		
	<?php 
	} 
?>