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
    <div class="fivecol"><h1>&nbsp; &nbsp;  &nbsp;Usuarios</h1></div>
    <div style="text-align: right;" class="sixcol">
        <input type="button" id="btnAgregarUsuario" name="btnAgregarUsuario" value="Agregar Usuario" class="button"/>

    </div>
</div>
<?php //} ?>


<div id="divDirectorio" class="table-responsive">

    <table id="tablaUsuarios" width="100%" class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($usuarios); $i++) {
                ?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

</div>

<!-- Div para ageragr empresas -->
<div id="agregarUsuario" style="display: none">
<?php
	$this->load->model("tipodocs");
        $this->load->model("rol");

        $data["tipodoc"] = $this->tipodocs->obtenerTipoDocumentos();
        $data["roles"] = $this->rol->obtenerRoles();
	$this->load->view("ajxusuarioins",$data);
?>
</div>