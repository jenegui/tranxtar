<?php 
	$sede = 0;
	$subsede = 0;
?>
<h1>Operativo</h1>
<form id="frmOperativo" name="frmOperativo" method="post" action="">
<table width="100%">
<tr>
  <td>
  <!-- Tabla de resumen del operativo -->
  <div id="tresumen">
  <table width="100%" class="table">
  <thead>
    <tr>
      <th>Descripci&oacute;n</th>
      <th align="center">Total</th>
      <th align="center">Porcentaje</th>
    </tr>
  </thead>
  <tbody>
  	<tr class="row1">
  	  <td>Directorio Base</td>
  	  <?php if ($informe["directorio_base"] > 0){ ?>
  	  			<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/0/$sede/$subsede"); ?>"><?php echo $informe["directorio_base"]; ?></a></td>
  	  <?php }else{ ?>			
  	  			<td align="center"><?php echo $informe["directorio_base"]; ?></td>
  	  <?php } ?>			  	  
  	  <td align="center"><?php echo $informe["pct_dbase"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row2">
  	  <td>Nuevos</td>
  	  <?php if ($informe["nuevos"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/1/$sede/$subsede"); ?>"><?php echo $informe["nuevos"]; ?></a></td>
  	  <?php } else{ ?>	
  	    <td align="center"><?php echo $informe["nuevos"]; ?></td>
  	  <?php } ?>  
  	  <td align="center"><?php echo $informe["pct_nuevos"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row1">
  	  <td>Total a recolectar</td>
  	  <?php if ($informe["total_recolectar"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/2/$sede/$subsede"); ?>"><?php echo $informe["total_recolectar"]; ?></a></td>
  	  <?php } else { ?>	
  	  	<td align="center"><?php echo $informe["total_recolectar"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_totrecolectar"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row2">
  	  <td>Sin distribuir</td>
  	  <?php if ($informe["sin_distribuir"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/3/$sede/$subsede"); ?>"><?php echo $informe["sin_distribuir"]; ?></a></td>
  	  <?php } else{ ?>	
  	  	<td align="center"><?php echo $informe["sin_distribuir"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_sindistribuir"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row1">
  	  <td>Distribuidos</td>
  	  <?php if ($informe["distribuidos"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/4/$sede/$subsede"); ?>"><?php echo $informe["distribuidos"]; ?></a></td>
  	  <?php } else{ ?>
  	  	<td align="center"><?php echo $informe["distribuidos"]; ?></td>	
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_distribuidos"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row2">
  	  <td>En digitaci&oacute;n</td>
  	  <?php if ($informe["digitacion"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/5/$sede/$subsede"); ?>"><?php echo $informe["digitacion"]; ?></a></td>
  	  <?php } else{ ?>	
  	  	<td align="center"><?php echo $informe["digitacion"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_digitacion"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row1">
  	  <td>Digitados</td>
  	  <?php if ($informe["digitados"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/6/$sede/$subsede"); ?>"><?php echo $informe["digitados"]; ?></a></td>
  	  <?php } else { ?>	
  	  	<td align="center"><?php echo $informe["digitados"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_digitados"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row2">
  	  <td>An&aacute;lisis - Verificaci&oacute;n</td>
  	  <?php if ($informe["analisis_verificacion"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/7/$sede/$subsede"); ?>"><?php echo $informe["analisis_verificacion"]; ?></a></td>
  	  <?php } else{ ?>	
  	  	<td align="center"><?php echo $informe["analisis_verificacion"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_analisisver"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row1">
  	  <td>Verificados</td>
  	  <?php if ($informe["verificados"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/8/$sede/$subsede"); ?>"><?php echo $informe["verificados"]; ?></a></td>
  	  <?php } else { ?>	
  	  	<td align="center"><?php echo $informe["verificados"]; ?></td>
  	  <?php } ?>	
  	  <td align="center"><?php echo $informe["pct_verificados"]; ?>&nbsp;%</td>
  	</tr>
  	<tr class="row2">
  	  <td>Novedades</td>
  	  <?php if ($informe["novedades"] > 0){ ?>
  	  	<td align="center"><a href="<?php echo site_url("critico/detalleOperativo/9/$sede/$subsede"); ?>"><?php echo $informe["novedades"]; ?></a></td>
  	  <?php } else{ ?>	
  	  	<td align="center"><?php echo $informe["novedades"]; ?></td>
  	  <?php } ?>
  	  <td align="center"><?php echo $informe["pct_novedades"]; ?>&nbsp;%</td>
  	</tr>
  </tbody>
  </table>
  </div>
  <!-- -->
  </td>
</tr>
</table>
</form>