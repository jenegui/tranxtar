
<br/>
<div class="row">
    <div class="fivecol"><h1>&nbsp; &nbsp; &nbsp;Generar usuarios y contrse&ntilde;as para los clientes</h1></div>
</div>
<br/>

 <div class="alert alert-success" role="alert">Tiene <?php echo $contar_fuentes; ?> cliente(s) pendientes para crear usuario y contrase&ntilde;a, haga click en el bot&oacute;n "Generar".</div>
 <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" id="frmGenerarUsuarios" name="frmGenerarUsuarios" method="post" action="<?php echo site_url("administrador/GeneraUsuarios"); ?>">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" id="btnGenerarUsuarios" name="btnGenerarUsuarios" class="btn-primary btn-lg">Generar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Div para generar usuarios establecimientos -->

