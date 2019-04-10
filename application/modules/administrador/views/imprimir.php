<div id="imprimir" class="container">

	<!-- Logo -->
	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-5 col-lg-3">

			<img class="img-responsive" src="../../../../../img/logos/logo-transxtar.png" alt="Transxtar SAS">

		</div>
		<div class="col-xs-12 col-sm-6 col-md-5 col-lg-9">



		</div>

	</div>




<!-- Contenido -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
        <br/><br/>    
		<p>
                <?php
                    echo "Guia No.".$guia['id_control']; 
                ?>    
            </p>
            <p>
                <?php
                    echo date("m/d/Y H:i:s"); 
                ?>   
            </p> 
		
		<p>
            <?php
                echo "Cliente: ".$guia['idnomcom']; 
            ?>
            </p>
            <p>
            <?php
                echo "Direcci&oacute;n: ".$guia['iddirecc'];
            ?>
            </p>
            <p>
            <?php
                echo "Tel&eacute;fono: ".$guia['idtelno'];
            ?>
            </p>
            <?php
                echo "Destinatario: ".$guia['nombre_destinatario'];
            ?>
            </p>
            <p>
            <?php
                echo "Ciudad dest: ".$guia['ciudadDest'];
            ?>
            </p>
            <p>
            <?php
                echo "Departamento dest: ".$guia['deptoDest'];
            ?>
            </p>
            <p>
            <?php
                echo "Direcci&oacute;n dest: ".$guia['direccion_destinatario'];
            ?>
            </p>
            <p>
            <?php
                echo "Tel&eacute;fono dest: ".$guia['telefono_destinatario'];
            ?>
            </p>
            <p>
            <?php
                echo "Unidades: ".$guia['unidades'];
            ?>
            </p>
            <p>
            <?php
                echo "Peso Kg: ".$guia['peso'];
            ?>
            </p>
            <p>
            <?php
                echo "Peso vol: ".$guia['peso_vol'];
            ?>
            </p>
            <p>
            <?php
                echo "Peso a cobrar: $".number_format($guia['peso_cobrar']);
            ?>
            </p>
            <p>
            <?php
                echo "Valor declarado: $".number_format($guia['valor_declarado']);
            ?>
            </p>
            <p>
            <?php
                echo "Flete: $".number_format($guia['flete']);
            ?>
            </p>
            <p>
            <?php
                echo "Costo manejo: ".($guia['costo_manejo']*100)."%";
            ?>
            </p>
            <p>
            <?php
                echo "Total flete: $".number_format($guia['total_fletes']);
            ?>
            </p>
            <p>
               <br>______________________________<br>
               Nombre quien recibe 
            </p>
            <p>
               ______________________________<br>  
               Firma: 
            </p>
            <p>
               ______________________________<br>
               Fecha:  
            </p>
		
		
        </div>

	<div class="col-xs-12 col-sm-6 col-md-5 col-lg-9">
            
    </div>


</div>


<!-- Footer -->

	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-3 text-center">
				<span>
				  
				Transportar SAS</br>
			 	Dirección: AV. Calle 6 # 31B-69</br>
				Teléfono: 6 961 068 
			  
			  </span>

			<br/>
			<br/>



			</div>


			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-9">



			</div>

		</div>
	</div>
</div>

<!-- Boton imprimir -->

	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-3 text-center">
				
				<!-- codigo js para incluir

					function printDiv() 
					{

					  var divToPrint=document.getElementById('DivIdToPrint');

					  var newWin=window.open('','Print-Window');

					  newWin.document.open();

					  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

					  newWin.document.close();

					  setTimeout(function(){newWin.close();},10);

					}


				-->
				
				
				<input type='button' id='btn' value='Imprimir' onclick='printDiv();'>
				
			</div>


			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-9">



			</div>

		</div>
	</div>
</div>