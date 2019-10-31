<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
            <?php $this->load->helper("url"); ?>
            <h1><strong>Bienvenido a la aplicacion web</strong></h1>
            <p>El objetivo de esta aplicaci&oacute;n es llevar el registro en l&iacute;nea de las operaciones log&iacute;sticas de la empresa mediante el registro y control de las guias, de los clientes y destinatarios, tambi&eacute;n permite la generaci&oacute;n de indicadores de gesti&oacute;n los cuales permiten guiar la implementaci&oacute;n de medidas o pol&iacute;ticas que beneficien la empresa. </p>
            <br/>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 fondo-pest1">

            <h1><strong>INICIAR SESIÓN</strong></h1>

            <br/>

            <div class="form-group">

                <form id="frmIngresar" name="frmIngresar" method="post" action="<?php echo site_url("login/validar"); ?>" accept-charset="utf-8">

                    <div class="form-group">
                        <input class="form-control" type="text" id="txtLogin" name="txtLogin" value="" maxlength="15" placeholder="Usuario *"/>
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="password" id="txtPassword" name="txtPassword" value="" maxlength="15" placeholder="Clave *"/>
                    </div>


                    <div>
                        <?php
                        if ($this->session->userdata("error_login") == 1) {
                            echo "<p style = 'font-size:12 px ; color: red'> Login/Password Incorrectos</p>";
                        } else {
                            echo "&nbsp;";
                        }
                        ?>
                    </div>

                    <div>
                        <button id="btnIngresar" name="btnIngresar" value="Ingresar" class="btn btn-primary btn-xl text-uppercase" type="submit">Ingresar</button>
                        <br/><br/>
                    </div>


                </form>
            </div>


        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 fondo-pest2">

            <h1><strong>HACER SEGUIMIENTO</strong></h1>

            <br/>

            <div class="">
                <div class="intro-text">

                    <div class="form-group">
                        <form id="numeroguia" name="numeroguia" method="post" action="<?php echo site_url("login/seguimiento"); ?>">
                            <input class="form-control" id="numGuia" name="numGuia" type="text" placeholder="Número de guía *">
                            <div class="clearfix">
                                <?php
                                if ($this->session->userdata("si") == 1) {
                                    /*strtoupper($this->session->userdata("placa")) */
                                    echo '<div class="alert alert-success">';
                                    echo "<p style = 'font-size:12 px'> Estimado Cliente, su carga est&aacute; en  estatus: " . strtoupper($this->session->userdata("guia")) . ".</p>";
                                    echo '</div>';
                                } else {
                                     echo '<div class="alert alert-success">';
                                    echo "<p style = 'font-size:12 px'> Estimado Cliente, digite el n&uacute;mero de guia y haga click en 'CONSULTAR'.</p>";
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <button id="seguimiento" name="seguimiento" class="btn btn-primary btn-xl text-uppercase" type="submit">Consultar</button>
                            <br/><br/>
                        </form>
                    </div>
                </div>
                <br/>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <br/><br/><br/>

            <h1><strong>REALIZAR COTIZACIÓN</strong></h1>
            <p>Tarifas desde Bogot&aacute; para env&iacute;o y distribuci&oacute;n de mercanc&iacute;as semi-masivas y paquetes a nivel urbano y nacional.</p>
            <form id="formCotizar" name="formCotizar" method="post" action="<?php echo site_url("login/cotizar"); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" id="cmbDeptoEstab" name="cmbDeptoEstab">
                                <option value="-">Seleccione depto...</option>
                                <?php for ($i = 0; $i < count($departamentos); $i++) { ?>
                                    <option value="<?php echo $departamentos[$i]["codigo"]; ?>"><?php echo $departamentos[$i]["nombre"]; ?></option>	
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="cmbMpioEstab" name="cmbMpioEstab" class="form-control">
                                <option value="-">Seleccione ciudad...</option>
                                <?php for ($i = 0; $i < count($municipios); $i++) { ?>
                                    <option value="<?php echo $municipios[$i]["codigo"]; ?>"><?php echo $municipios[$i]["nombre"]; ?></option> 
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="pesoKg" name="pesoKg" type="text" placeholder="Peso Kg mínimo: 30 kg *">
                        </div>
                        <div class="form">
                        <input class="form-control" id="cantidad" name="cantidad" type="text" placeholder="Cantidad">
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" id="valdeclarado" name="valdeclarado" type="text" placeholder="Valor declarado *">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="alto" name="alto" type="text" placeholder="Alto del paquete(cm) *">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="ancho" name="ancho" type="text" placeholder="Ancho del paquete(cm) *">
                        </div>
                        <div class="form-group">
                            <input class="form-control" id="largo" name="largo" type="text" placeholder="Largo del paquete(cm) *">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    
                    <div class="col-lg-12 text-center">

                        <button id="btnCotizar" name="btnCotizar" class="btn btn-primary btn-xl text-uppercase" type="submit">Cotizar</button>
                    </div>
                    <div class="clearfix">
                        
                    </div>
                </div>
            </form>
            
            <?php
                if($this->session->userdata("flete") == 1) {
                    echo '<div class="alert alert-success">';
                    echo "<div id='anchor'>Los costos de env&iacute;o desde BOGOT&Aacute; hacia ".$this->session->userdata("mpio")."</div>";
                    echo "<div>Valor del flete $".number_format($this->session->userdata("valorFlete"))."</div>";
                    echo "<div>Costo de manejo $".number_format($this->session->userdata("costoManejo"))."</div>";
                    echo "<div>Valor total flete:  $".number_format($this->session->userdata("totalFlete"))."</div>";
                    
                    echo "<div>El costo de manejo corresponde al 1% del valor declarado.</div>";
                    echo "<div>El costo de manejo puede variar seg&uacute;n el valor declarado.</div>";
                    echo '</div>';
                } elseif($this->session->userdata("flete") == 2) {
                    echo '<div class="alert alert-success">';
                    echo "&nbsp; Para la ciudad seleccionada no se est&aacute; prestando servicio de transporte.";
                    echo '</div>';
                }else{
                    echo "&nbsp;";
                }
                ?>
        </div>
    </div>

</div>