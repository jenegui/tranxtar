<!-- -->
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
<?php //if (($ano_periodo == $reciente["ano"])&&($mes_periodo == $reciente["mes"])){ ?>   
<div class="row">
    <div class="fivecol"><h1>&nbsp; &nbsp;  &nbsp;Operarios externos</h1></div>
    <div style="text-align: right;" class="sixcol">
        <input type="button" id="btnAgregarOperario" name="btnAgregarOperario" value="Agregar Operarios" class="button"/>

    </div>
</div>	 
<?php //} ?>
<div id="divUsuarios" class="table-responsive">
    <table id="tablaOperarios" width="100%" class="table">
        <thead class="thead">
            <tr>
                <th width="40%">Nombre operario</th>
                <th>Identificaci&oacute;n</th>
                <th>Tel&eacute;fono</th>
                <th>No. placa veh&iacute;culo</th>
                <th align="center" width="10%">Estado</th>
                <th align="center" width="10%">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($usuarios); $i++) {
                if ($usuarios[$i]["nombre_operario"] != "") {
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center">
                            &nbsp;
                        </td>
                        <td align="center">
                            &nbsp;
                        </td>
                        <td align="center">
                            <?php //if (($ano_periodo == $reciente["ano"])&&($mes_periodo == $reciente["mes"])){   ?> 
                            <a href="javascript:modificarOperarioADM(<?php echo $usuarios[$i]["id_operario"]; ?>);"><img src="<?php echo base_url("images/edit.png"); ?>" border="0"/></a>
                            <?php //}   ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>   

    </table>   
</div>   

<!-- Div para ageragr empresas -->
<div id="agregarOperario" style="display: none">
    <?php
    $this->load->model("tipodocs");
    $this->load->model("rol");

    $data["tipodoc"] = $this->tipodocs->obtenerTipoDocumentos();
    $data["roles"] = $this->rol->obtenerRoles();
    $this->load->view("ajxusoperins", $data);
    ?>
</div>