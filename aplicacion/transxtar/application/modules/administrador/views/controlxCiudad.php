<table id="example" class="display nowrap table" style="font-size: 10px;"> 
	<thead>
	<tr>
		<th>N.Guia</th>
		<th>N.Remesa</th>
		<th>Nombre cliente</th>
		<th>Nombre destinatario</th>
		<th>Ciudad Destinatario</th>
		<th>Fecha entrega</th>
		<th>Tipo de carga</th>
		<th>Estatus de la carga</th>
		<th width="55%">Observaciones</th>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i<count($control); $i++){ 
		   
		    
		?>
		<tr>
		    <td><?php echo $control[$i]['id_control']; ?></td> 
		    <td><?php echo $control[$i]['nroRemesa']; ?></td> 
		    <td><?php echo $control[$i]['idnomcom']; ?></td> 
		    <td><?php echo $control[$i]['nombre_destinatario']; ?></td> 
		    <td><?php echo $control[$i]['ciudadDest']; ?></td> 
		    <td><?php echo $control[$i]['fecha_actualizacion']; ?></td> 
		    <td><?php echo $control[$i]['tipoCarga']; ?></td> 
		    <td><?php echo $control[$i]['nom_estado']; ?></td> 
		    <td><?php echo $control[$i]['observaciones']; ?></td> 
	    </tr>
		<?php } ?>
	</tbody>
</table>


