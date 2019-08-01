<?php
$this->load->library("general");
$style = 'style="color: #FF0000; font-weight: bold;"';
if(count($usuarios)<=0){
	echo '<div style="color:#FF0000;" align="center">La empresa no tiene registrados establecimientos!!!</div>';
}
else{
	?>
		<?php	$style = 'style="color: #FF0000; font-weight: bold;"'; ?>
		<div id="reporteOPCritico">
		<table width="100%" class="table" style="font-size: 11px;" border="1">
		<thead>
		<tr>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">nom_usuario</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">log_usuario	</th>
		  <th style="border-right: 1px solid #CCCCCC;" align="center">pass_usuario</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		for ($i=0; $i<count($usuarios); $i++){
				$var = ($i%2!=0)?"row2":"row1";
				$html='<tr class="'.$var.'">';
				$html.='<td align="rigth">'.$usuarios[$i]["nom_usuario"].'</td>';
		  		$html.='<td align="center">'.$usuarios[$i]["log_usuario"].'</td>';
		  		$html.='<td align="center">'.$usuarios[$i]["pas_usuario"].'</td>';
		  	$html.='</tr>';
		  	echo $html;
		}
		?>	
		</tbody>
		</table>
		<br/>
		</div>
		
	<?php 
	//echo ("<center><<<<a href='javascript:history.back(1)'>Regresar</a></center>");
	} 
?>