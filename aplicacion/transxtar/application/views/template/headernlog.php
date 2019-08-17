<?php $url = site_url(); ?>
<div class="container"	

     <div id="header" class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> <!--Logo-->

            <a href="<?php echo $url; ?>index.php"><img class="img-responsive" src="<?php echo $url; ?>images/logo.png" alt="Transxtar SAS"></a>

        </div>


        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">



            <div class="sevencol last">
                <?php
                if ($controller == "miniencuesta") {
                    ?>
                    <div id='textlogo1'>
                        <h1><?php echo $this->config->item("header"); ?></h1>
                    </div>
                    <?php
                } else {
                    ?>
                    <div id="textlogo">
                        <h1><?php echo $this->config->item("header"); ?></h1>
                    </div>
                    <?php
                }
                if ($controller == "miniencuesta") {
                    //echo "<div id='textfecha'>Fecha de diligenciamiento: <br> ". date('d/m/Y') ."</div>";
                    // echo "<div align='right'>Fecha de  diligenciamiento: <br> ". date('d/m/Y') ."</div>"; 
                }
                ?>
                <div id="periodo">			
                    <b>&nbsp;</b>			
                </div>
            </div>
            <div id="textnota">
                <?php
                if ($controller == "miniencuesta") {
                    echo "<p style='text-align:justify; border: white 1px solid; margin: 2px;'><b>IMPORTANTE:</b> los datos que el DANE solicita en este formulario son estrictamente confienciales y en ning&uacute;n caso tienen fines fiscales ni pueden utilizarse como prueba judicial.<br> </p>";
                } else {
                    if (isset($nom_usuario)) {
                        $usuario = '<div id="usuario" style="font-size:10pt">';
                        if ($tipo_usuario != 'FUENTE' && $tipo_usuario != 'ADMINISTRADOR') {
                            $usuario .= $tipo_usuario . " - ";
                        }
                        $usuario .= $nom_usuario;
                        $usuario .= '</div>';
                        if ($controller != "miniencuesta") {
                            echo $usuario;
                        }
                    }
                }
                ?>        
            </div>


        </div>
    </div>
</div>
