<div id="DivIdToPrint" class="container">

    <!-- Logo -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 head">

            <img class="img-responsive pequena" src="<?php echo base_url("images/logo-transxtar.png"); ?>">

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-3 text-center head">
            <span alingn="center">
                Tranxtar SAS</br>
                Dirección: AV. Calle 6 # 31B-69</br>
                Teléfono: 6 961 068 
                <br>
            </span>
        </div>
    </div>
    <div class="row">
        <div>
            <br>
        </div>
    </div>
    <!-- Contenido -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 text-center">
            <?php
            echo "<b>GUIA No." . $guia['id_control'] . "</b>";
            ?>    
        </div>
    </div>
    <div class="row">       
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 text-center">
            <?php
            //echo date("m/d/Y H:i:s"); //Se quita por solicitud enviada por correo 15/10/2019 desde el correo de Maryuri Acuña 
            $hora = strtotime($guia['fechaRegistro']);
            echo date('d-m-Y H:i:s',$hora);
            ?>   
        </div>
    </div>
    <div class="row">       
        <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12">
            <?php
            echo "<b>Cliente</b>: " . $guia['idnomcom'];
            ?>
        </div>
    </div>
    <div class="row">     
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Direcci&oacute;n</b>: " . $guia['iddirecc'];
            ?>
        </div>
    </div>
    <!--div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            //echo "<b>Tel&eacute;fono</b>: " . $guia['idtelno'];
            ?>
        </div>
    </div-->
    <div class="row">    
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-12">
            <?php
            echo "<b>Destinatario</b>: " . $guia['nombre_destinatario'];
            ?>
        </div>     
    </div>
    <div class="row">         
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Ciudad dest</b>: " . $guia['ciudadDest'];
            ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Departamento dest</b>: " . $guia['deptoDest'];
            ?>
        </div> 
    </div>
    <div class="row">        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Direcci&oacute;n dest</b>: " . $guia['direccion_destinatario'];
            ?>
        </div>
    </div>
    <!--div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            //echo "<b>Tel&eacute;fono dest</b>: " . $guia['telefono_destinatario'];
            ?>
        </div>     
    </div-->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Unidades</b>: " . $guia['unidades'];
            ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            $pesoVol = (($guia['alto'] / 100) * ($guia['ancho'] / 100) * ($guia['largo'] / 100)) * 400;
            $pesoKg = $guia['peso'];
            if ($pesoVol > $pesoKg) {
                echo "<b>Peso vol</b>: " . $pesoVol;
            } else {
                echo "<b>Peso Kg</b>: " . $guia['peso'];
            }
            ?>
        </div>  
    </div>
    <div class="row">         
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Valor declarado</b>: $" . number_format($guia['valor_declarado']);
            ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Flete</b>: $" . number_format($guia['flete']);
            ?>
        </div>
    </div>
    <div class="row">         
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Costo manejo</b>: " . ($guia['costo_manejo'] * 100) . "%";
            ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Total flete</b>: $" . number_format($guia['total_fletes']);
            ?>
        </div>
    </div>
    <div class="row">        
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            if ($guia['forma_pago'] == 1) {
                $formaPago = 'Contado';
            } elseif ($guia['forma_pago'] == 2) {
                $formaPago = 'Contra entrega';
            } else {
                $formaPago = 'Cr&eacute;dito';
            }
            echo "<b>Forma de pago</b>: " . $formaPago;
            ?>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
            <?php
            echo "<b>Observaci&oacute;n</b>: ".$guia['observaciones'];
            ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-xs-1 col-sm-1 col-md-5 col-lg-12">
            <br>______________________________<br>
            Nombre quien recibe 
        </div>
        <div class="col-xs-1 col-sm-1 col-md-5 col-lg-12">
            _____________________________<br>
            N&uacute;mero de identificaci&oacute;n
        </div>
        <div class="col-xs-1 col-sm-1 col-md-5 col-lg-12">
            ______________________________<br>  
            Firma: 
        </div>
        <div class="col-xs-1 col-sm-1 col-md-5 col-lg-12">
            ______________________________<br>
            Fecha: 
            <br>
        </div>
    </div>
    <div><br></div>
<!-- Footer -->
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-3 text-center pie">
                

            </div>
        </div>
    </div>
</div>
<!-- Boton imprimir -->

<div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-3 text-center">
            <script type="text/javascript">

                function printDiv()
                {
                    var divToPrint = document.getElementById('DivIdToPrint');
                    var newWin = window.open('', 'Print-Window');
                    var htmlToPrint = '' +
                    '<style type="text/css">' +
                    'table th, table td {' +
                    'border:1px solid #000;' +
                    'padding;0.5em;' +
                    '}' +
                    '@page {'+
                    'size: auto;'+
                    'margin: 10%;'+
                    '}'+
                    '@page :first  {'+
                    'margin-top: 0.3cm;'+
                    '}'+
                    '@page :right {'+
                    'margin-left: 14cm;'+
                    'margin-right: 13cm;'+
                    '}'+
                    'div.container {'+
                    'font-size : 9pt;'+ 
                    'font-family : arial,helvetica;'+ 
                    'font-weight : normal;'+
                    'text-align: justify;'+
                    '}'+
                    'div.head {'+
                    'font-size : 7pt;'+ 
                    'font-family : arial,helvetica;'+ 
                    'font-weight : normal;'+
                    'margin-left: auto;'+
                    'margin-right: auto;'+
                    'text-align: center;'+
                    '}'+
                    'img.pequena{'+
                    'width: 150px; height: 90   px;'+
                    '}'+
                    '@page { margin: 0; }'+
                    '@media print {'+
                    '@page { margin: 0; }'+
                    'body { margin-top: 3.0cm; }'+
                    'body { margin-left: 7.0cm; }'+
                    'body { margin-right: 8.0cm; }'+
                    '}'+
                    '</style>';
                    htmlToPrint += divToPrint.outerHTML;
                    newWin.document.open();
                    newWin.document.write('<html>');
                    newWin.document.write('<head>');
                    newWin.document.write('</head>');
                    newWin.document.write('<body onload="window.print()">' + htmlToPrint + '</body>');
                    newWin.document.write('</html>'); 
                    newWin.document.close();
                    
                    setTimeout(function () {
                        newWin.close();
                    }, 10);

                }
            </script>
            <input type='button' id='btn' value='Imprimir' onclick='printDiv();'>
        </div>
    </div>
</div>
