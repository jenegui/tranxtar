<h1>Cierre de Periodos</h1>
<p> Se dispone a realizar el cierre del periodo <?php echo $nombre_actual; ?> (<?php echo $periodo_actual["ano"]." - ".$periodo_actual["mes"]; ?>) y a realizar la apertura 
    del periodo <?php echo $nombre_nuevo; ?> (<?php echo $ano_nuevo." - ".$mes_nuevo; ?>). 
</p>
<br/>
<h3>Resumen del periodo actual (Periodo a cerrar):</h3>
<br/>
<table class="table" width="100%">
    <tr>
        <td>
            <table class="table" width="40%">
            <thead>
            <tr>
              <th width="75%">Estado</th>
              <th align="center">Cantidad</th>
            </tr>
            </thead>
            <tbody>
            <tr class="row2">
              <td>Directorio Base: </td>
              <td align="center"><b><?php echo $dirbase; ?></b></td>
            </tr>
            <tr class="row1">
              <td>Nuevos: </td>
              <td align="center"><b><?php echo $nuevos; ?></b></td>
            </tr>
            <tr class="row2">
              <td>Total a recolectar: </td>
              <td align="center"><b><?php echo $dirbase + $nuevos; ?></b></td>
            </tr>
            </tbody>
            </table>
            <br/>
            <table class="table" width="40%">
            <thead>
            <tr>
              <th>Estado</th>
              <th align="center">Cantidad</th>
            </tr>
            </thead>
            <tbody>
            <tr class="row1">
              <td>Formularios sin distribuir: </td>
              <td align="center"><b><?php echo $sindistribuir; ?></b></td>
            </tr>
            <tr class="row2">
              <td>Formularios distribuidos: </td>
              <td align="center" style="color: #FF0000;"><b><?php echo $distribuido; ?></b></td>
            </tr>
            <tr class="row1">
              <td>Formularios en digitaci&oacute;n: </td>
              <td align="center" style="color: #FF0000;"><b><?php echo $digitacion; ?></b></td>
            </tr>
            <tr class="row2">
              <td>Formularios digitados: </td>
              <td align="center" style="color: #FF0000;"><b><?php echo $digitados; ?></b></td>
            </tr>
            <tr class="row1">
              <td>Formularios en an&aacute;lisis - verificaci&oacute;n: </td>
              <td align="center"><b><?php echo $analverif; ?></b></td>
            </tr>
            <tr class="row2">
              <td>Formularios verificados:</td>
              <td align="center"><b><?php echo $verificados; ?></b></td>
            </tr>
            <tr class="row1">
              <td>Formularios con novedades:</td>
              <td align="center"><b><?php echo $novedades; ?></b></td>
            </tr>
            </tbody>
            </table>
            <input type="hidden" id="hddAno" name="hddAno" value="<?php echo $periodo_actual["ano"]; ?>"/>
            <input type="hidden" id="hddMes" name="hddMes" value="<?php echo $periodo_actual["mes"]; ?>"/>
            <br/>
            <input type="button" id="btnCierrePer" name="btnCierrePer" value="Cierre / Apertura de periodos" class="button"/>
        </td>
        <td>
            <form id="frmSalarioMin" name="frmSalarioMin" method="post" action="">
                <legend><b>&nbsp;Salario m&iacute;nimo periodo <?php echo $periodo_actual["ano"]." - ".$periodo_actual["mes"]; ?></b></legend>
                <table class="table" width="60%">
                    <tr>
                        <td>

                            Salario m&iacute;nimo

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="salario" name="salario" value="<?php echo $salario; ?>" size="20" maxlength="20" class=""> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <input type="submit" id="btnSalarioMin" name="btnSalarioMin" value="Salario Mínimo" class="button"/>  
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
             </form>
        </td>
    </tr>
</table>
