<?php
$this->load->library("general");
$style = 'style="color: #FF0000; font-weight: bold;"';
if(count($estabEmpresa)<=0){
	echo '<div style="color:#FF0000;" align="center">La empresa no tiene registrados establecimientos!!!</div>';
}
else{
	?>
		<?php	$style = 'style="color: #FF0000; font-weight: bold;"'; ?>
		<div id="reporteOPCritico">
		<table width="100%" class="table" style="font-size: 11px;">
		<thead>
		<tr>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Cod. Establecimiento</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Nombre Establecimineto</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Direcci&oacute;n</th>
		  <?php
		  if($cierre!="ListaEstUlocal"){
		  ?>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">Maracar cierre establecimiento</th>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
		<?php 
		for ($i=0; $i<count($estabEmpresa); $i++){
				//$calificacion=explode(",",$calific);
				$establecimiento=$estabEmpresa[$i]["nro_establecimiento"];
		  	  	$var = ($i%2!=0)?"row2":"row1";
				$html='<tr class="'.$var.'">';
				$html.='<td align="center">'.$estabEmpresa[$i]["nro_establecimiento"].'</td>';
		  		$html.='<td align="center">'.$estabEmpresa[$i]["idnomcom"].'</td>';
		  		$html.='<td align="center">'.$estabEmpresa[$i]["direccion"].'</td>';
		  		if($cierre!="ListaEstUlocal"){
			  		if($estabEmpresa[$i]["estadoEst"]==1){
						$cierre="cierre";
			  			$html.='<td align="center"><a href="'.site_url("/empresa/cierre_establecimientos/$establecimiento/$cierre").'" title="Haga click aqui para marcar cierre del estableciminetio">Abierto</a></td>';
			  		}else{
						$html.='<td align="center"><a href="'.site_url("/empresa/cierre_establecimientos/$establecimiento/$cierre").'" title="Haga click aqui para marcar el estableciminetio como activo">Cerrado</a></td>';
					}
				}
		  	$html.='</tr>';
		  	echo $html;
		}
		?>	
		</tbody>
		</table>
		<br/>
		</div>
		
	<?php 
	echo ("<center><<<<a href='javascript:history.back(1)'>Regresar</a></center>");
	} 
?>