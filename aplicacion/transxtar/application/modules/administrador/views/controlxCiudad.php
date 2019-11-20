<table id="example" class="display nowrap table" style="font-size: 10px;"> 
	<thead>
	<tr>
		<th>N.Guia</th>
		<th>Nombre cliente</th>
		<th>Fecha recogida</th>
		<th>Fecha entrega</th>
		<th>Nombre destinatario</th>
		<th>Ciudad destinatario</th>
		<th>Depto destinatario</th>
		<th>Valor flete</th>
		<th>Peso Kg</th>
		<th>Peso Vol.</th>
		<th>Estado de la carga</th>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i<count($control); $i++){ 
		   
		    
		?>
		<tr>
		    <td><?php echo $control[$i]['id_control']; ?></td> 
		    <td><?php echo $control[$i]['idnomcom']; ?></td> 
		    <td><?php echo $control[$i]['fecha_recogida']; ?></td> 
		    <td><?php echo $control[$i]['fecha_entrega']; ?></td> 
		    <td><?php echo $control[$i]['nombre_destinatario']; ?></td> 
		    <td><?php echo $control[$i]['ciudadDest']; ?></td> 
		    <td><?php echo $control[$i]['deptoDest']; ?></td> 
		    <td><?php echo $control[$i]['total_fletes']; ?></td> 
		    <td><?php echo $control[$i]['peso']; ?></td> 
		    <td><?php echo $control[$i]['peso_vol']; ?></td> 
		    <td><?php echo $control[$i]['nom_estado']; ?></td> 
		</tr>
		<?php } ?>
	</tbody>
</table>


