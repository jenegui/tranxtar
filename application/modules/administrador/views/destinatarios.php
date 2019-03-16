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
    <div class="fivecol"><h1>Directorio destinatarios</h1></div>
    <div style="text-align: right;" class="sixcol">
        <input type="button" id="btnAgregarDestinatario" name="btnAgregarDestinatario" value="Registrar destinatarios" class="button"/>

    </div>
</div>	 
<?php //} ?>

<table width="100%" style="font-size: 11px;">
    <tr>
        <td>
            <div id="divUsuarios">
                <form id="frmUsuarios" name="frmUsuarios" method="post" action="">
                    <table width="100%" id="tablaDestinatarios" class="table">
                        <thead class="thead">
                            <tr>
                                <th width="40%">Id Destinatario</th>
                                <th width="40%">Nombre destinatario</th>
                                <th>Identificaci&oacute;n</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Tel&eacute;fono</th>
                                <th>Direcci&oacute;n</th>
                                <th>Contacto</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($destinatarios); $i++) {
                                if ($destinatarios[$i]["nombre_destinatario"] != "") {
                                    if (($i % 2) == 0)
                                        $class = "row1";
                                    else
                                        $class = "row2";
                                    ?>
                                    <tr class="<?php echo $class; ?>">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>   
                        <!-- links -->
                        <tfoot>
                            <tr>
                                <td colspan="7">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" align="left">&nbsp;</td>
                                <td colspan="4" align="right" class="links"><?php echo $links; ?></td>
                            </tr>
                        </tfoot>
                        <!-- links -->
                    </table>   
                </form>
            </div>   
        </td> 
    </tr>
    <tr>
        <td>
            <div id="detalle"></div>
        </td> 
    </tr>
</table>
<!-- Div para ageragr empresas -->
<div id="agregarDestinatario" style="display: none">
    <?php
    $this->load->model("tipodocs");
    $this->load->model("rol");

    $data["tipodoc"] = $this->tipodocs->obtenerTipoDocumentos();
    $data["roles"] = $this->rol->obtenerRoles();
    $this->load->view("ajxusoperins", $data);
    ?>
</div>