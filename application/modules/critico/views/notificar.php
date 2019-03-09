<form id="frmNotFuente" name="frmNotFuente" method="post" action="<?php echo site_url("critico/notificar1"); ?>">
<fieldset style="padding: 10px; border: 1px solid #CCCCCC">
    <legend><b>&nbsp;Notificaci&oacute;n fuente <?php echo $establecimiento; ?>  &nbsp;</b></legend>
<table>
<tr>
<td>
    <table>
    <tr>
      <td width="80%"valign="bottom" rowspan="0">Fecha de notificaci&oacute;n:</td>
    </tr>
    <tr>
        <td><input type="text" id="fechaNotificacion" name="fechaNotificacion" value="<?php //echo $modulo1["finicial"]; ?>" class="textbox" <?php //$this->general->bloqueoCampo($bloqueo); ?>/></td>
    </tr>
    </table>
</td>
</tr>
</table>
</fieldset>

<br/>

<input type="submit" id="btnNotificarFuente" name="btnNotificarFuente" value="Notificar fuente" class="button"/>
<input type="hidden" id="nro_orden" name="nro_orden" value="<?php echo $empresa; ?>"/>
<input type="hidden" id="nro_establecimiento" name="nro_establecimiento" value="<?php echo $establecimiento; ?>"/>
</form>
<br>
<?php

if($notificacion["fecha_notificacion"]!=""){
    echo '<hr>';
    echo '<div id="container">';
        echo '<div class="twocol">';
            echo '<div style="font-size:11pt; color:blue;">';
                 echo "Fecha de notificación: ";
             echo '</div>';
             echo '<div style="font-size:11pt; color:blue;">';
                 echo $notificacion["fecha_notificacion"];
             echo '</div>';
        echo '</div>';
        echo '<div class="">';
            echo '<div style="font-size:11pt; color:blue;">';
                 echo "Estado";
             echo '</div>';
             echo '<div style="font-size:11pt; color:blue;">';
                 echo $notificacion["nom_estado"];
             echo '</div>';
        echo '</div>'; 
    echo '</div>';
    echo '<hr>';
}
?>