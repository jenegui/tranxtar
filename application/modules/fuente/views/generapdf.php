<?php 
$this->load->helper("url");
include_once 'application/libraries/html2pdf-4.4.0/html2pdf.class.php';
$this->load->helper("url");
$this->config->load('sitio');
$title = $this->config->item('title');
$header = $this->config->item('header');
$footer = $this->config->item('footer'); 
$contenido='<page backtop="30mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page">';
    $contenido.='<page_header>';
    $contenido.='<img src="'.base_url("images/bannertoppdf.png").'"/> '.$header.''; 
    $contenido.='</page_header>';
    $contenido.='<page_footer>';
    $contenido.='<p align="center" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10;">DANE: Carrera 59 No. 26-70 Interior I - CAN. Conmutador (571) 5978300 - Fax (571) 5978399<br/>L&iacute;nea gratuita de atenci&oacute;n 01-8000-912002. &oacute; (571) 5978300 Exts. 2532 - 2605</p>'; 
    $contenido.='</page_footer>';
    $contenido.='<p style="background-color: #DFDFDF;">M&oacute;dulo I - Identificaci&oacute;n y datos generales </p>
                <p><b><font style="font-size: 12">1. Ubicaci&oacute;n y datos generales de la empresa</font></b></p>
                <table  border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                <tr>
                  <td colspan="3"><b>Raz&oacute;n Social:</b>&nbsp;'.$modulo1["idproraz"].'</td>
                </tr>
                <tr>
                  <td><b>Nombre Comercial:</b>&nbsp;'.$modulo1["idnomcom"].'</td>
                  <td colspan="2"><b>Sigla: </b>&nbsp;'.$modulo1["idsigla"].'</td>
                </tr>
                <tr>
                  <td colspan="3"><b>Direcci&oacute;n:</b>&nbsp;'.$modulo1["iddirecc"].'</td>
                </tr>
                <tr>
                  <td><b>Departamento:</b>&nbsp;'.$modulo1["iddepto"].'</td>
                  <td colspan="2"><b>Municipio:</b>&nbsp;'.$modulo1["idmpio"].'</td>
                </tr>
                <tr>
                  <td><b>Tel&eacute;fono:</b>&nbsp;'.$modulo1["idtelno"].'</td>

                  <td><b>P&aacute;gina Web:</b>&nbsp;'.$modulo1["idpagweb"].'</td>
                </tr>
                <tr>
                  <td colspan="3"><b>E-mail gerencia:</b>&nbsp;'.$modulo1["idcorreo"].'</td> 
                </tr>
                <tr>
                        <td><b>Operador o cadena hotelera al que pertenece::</b>&nbsp;'.$modulo1["nom_cadena"].'</td>
                </tr>
                </table>
                
                <p><b><font style="font-size: 12">2. Informaci&oacute;n general del establecimiento</font></b></p>
                <table  border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                <tr>
                  <td><b>Nombre del establecimiento:</b>&nbsp;'.$modulo1["idnomcomest"].'</td>
                  <td colspan="2"><b>Sigla:</b>&nbsp;'.$modulo1["idsiglaest"].'</td>
                </tr>
                <tr>
                  <td colspan="3"><b>Direcci&oacute;n del establecimiento:</b>&nbsp;'.$modulo1["iddireccest"].'</td>
                </tr>
                <tr>
                  <td><b>Departamento:</b>&nbsp;'.$modulo1["iddeptoest"].'</td>
                  <td colspan="2"><b>Municipio:</b>&nbsp;'.$modulo1["idmpioest"].'</td>
                </tr>
                <tr>
                  <td><b>Tel&eacute;fono:</b>&nbsp;'.$modulo1["idtelnoest"].'</td>

                  <td><b>Email establecimiento:</b>&nbsp;'.$modulo1["idcorreoest"].'</td>
                </tr>
                </table>
                
                <p style="background-color: #DFDFDF;">M&oacute;dulo II - Personal ocupado promedio y salarios causados en el mes</p>
                <table  border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                <thead style="background-color: #DFDFDF; font-weight: bold;">
                <tr>
                  <th style="width: 22%;height:6 px;text-align:center">TIPO DE CONTRATACI&Oacute;N</th>
                  <th style="width: 22%;height:6 px;text-align:center">N&uacute;mero promedio de personas ocupadas en el mes</th>
                  <th style="width: 22%;height:6 px;text-align:center">Total sueldos y salarios causados por el personal ocupado enel mes (miles de pesos)</th>
                  <th style="width: 22%;height:6 px;text-align:center">Costo de personal (miles de pesos)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td style="width: 32%;height:6 px;text-align:left">1. Propietarios, socios y familiares sin remuneraci&oacute;n fija</td>
                  <td align="center">'.$modulo2["potpsfr"].'</td>
                  <td align="center">&nbsp;</td>
                  <td style="text-align:center">&nbsp;</td>
                </tr>
                <tr>
                  <td style="width: 32%;height:6 px;text-align:left">2. Personal permanente (Contrato a t&eacute;rmino indefinido)</td>
                  <td align="center">'.$modulo2["potperm"].'</td>
                  <td align="center">'.$modulo2["gpper"].'</td>
                  <td style="text-align:center">&nbsp; </td>    
                </tr>
                <tr>
                  <td style="width: 32%;height:6 px;text-align:left">3. Personal temporal contratado directamente por el hotel (Contrato a t&eacute;rmino definido)</td>
                  <td align="center">'.$modulo2["pottcde"].'</td>
                  <td align="center">'.$modulo2["gpssde"].'</td>
                  <td style="text-align:center">&nbsp; </td>    
                </tr>
                <tr>
                  <td style="width: 32%;height:6 px;text-align:left">4. Personal temporal contratado a trav&eacute;s de empresas especializadas</td>
                  <td align="center">'.$modulo2["pottcag"].'</td>
                  <td style="text-align:center">&nbsp;</td>    
                  <td align="center">'.$modulo2["gpppta"].'</td>
                </tr>
                <tr>
                  <td style="width: 32%;height:6 px;text-align:left">5. Aprendices y pasantes (Universitarios, t&eacute;cnicos y tecn&oacute;logos) Ley 789 de 2002</td>
                  <td align="center">'.$modulo2["potpau"].'</td>
                  <td align="center">'.$modulo2["gppgpa"].'</td>
                  <td style="text-align:center">&nbsp;</td>    
                </tr>
                <tr>
                  <td>6. Total</td>
                  <td align="center">'.$modulo2["pottot"].'<br>(Suma numerales 1 a 5)</td>
                  <td align="center">'.$modulo2["gpsspot"].'<br>(Suma numerales 2,3 y 5)</td>
                  <td style="text-align:center">&nbsp;</td>    
                </tr>
                </tbody>
                </table>
                
                <p style="background-color: #DFDFDF;">M&oacute;dulo III - Ingresos netos operacionales causados en el mes (miles de pesos)</p>
                <table  border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                <tr>
                  <td style="width: 74%;height:6 px;text-align:left">1. Alojamiento.</td>
                  <td align="center">'.$modulo3["inalo"].'</td>
                </tr>
                <tr>
                  <td style="width: 72%;height:6 px;text-align:left">2. Servicios de restaurante y catering para eventos (alimentos y bebidas no alcoh&oacute;licas), no incluidos en el valor de la tarifa de alojamiento.</td>
                  <td align="center">'.$modulo3["inali"].'</td>
                </tr>
                <tr>
                  <td style="width: 72%;height:6 px;text-align:left">3. Servicios de bar (bebidas alcoh&oacute;licas y cigarrillos), no incluidos en el valor de la tarifa de alojamiento.</td>
                  <td align="center">'.$modulo3["inba"].'</td>
                </tr>
                <tr>
                        <td style="width: 72%;height:6 px;text-align:left">4. Servicios receptivos (city tours, gu&iacute;as tur&iacute;sticos, pasad&iacute;as, organizaci&oacute;n de viajes, operadores, servicios similares y conexos).</td>
                        <td  align="center">'.$modulo3["insr"].'</td>
                </tr>
                <tr>
                    <td style="width: 70%;height:6 px;text-align:left">
                        <table style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                                <tr>
                                    <td style="width: 45%;height:6 px;text-align:left" rowspan="2">
                                            5. Organizacion de eventos:
                                    </td>
                                    <td style="width: 45%;height:6 px;text-align:left">
                                            a) Convenciones (MICE).
                                    </td>
                                    <td>'.$modulo3["inoeconv"].'</td>
                                </tr>
                                <tr>	
                                    <td style="width: 45%;height:6 px;text-align:left">
                                            b) Eventos sociales.
                                    </td>
                                    <td>'.$modulo3["inoeeven"].'</td>
                                </tr>
                        </table>
                    </td>
                    <td style="width: 25%;height:6 px;text-align:center">'.$modulo3["inoe"].'</td>
                </tr>
                <tr>
                  <td style="width: 72%;height:6 px;text-align:left">6. Otros ingresos operacionales no solicitados anteriormente.</td>
                  <td align="center">'.$modulo3["inoio"].'</td>
                </tr>
                <tr>
                  <td style="width: 72%;height:6 px;text-align:left">6. Total de ingresos operacionales (Sin IVA)</td>
                  <td align="center">'.$modulo3["intio"].'</td>
                </tr>
                </table>
                
                <p style="background-color: #DFDFDF;">M&oacute;dulo IV - Caracter&iacute;sticas de los hoteles</p>
                <table border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                    <tr>
                        <td colspan="5">
                                <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                    <tr>
                          <td rowspan="4">1. N&uacute;mero de habitaciones:</td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            Ofrecidas mes
                        </td>
                        <td colspan="2" style="text-align:center">
                            Ocupadas mes
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td> a). Por venta directa</td>
                        <td> b). Por tiempo compartido</td>
                        <td>Total habitaciones ocupadas </td>
                    </tr>   
                    <tr>
                        <td style="text-align:center">'.$modulo4["ihdo"].'</td>
                        <td style="text-align:center">'.$modulo4["ihoavd"].'</td>
                        <td style="text-align:center">'.$modulo4["ihoatc"].'</td>
                        <td style="text-align:center">'.$modulo4["ihoa"].'</td>
                    </tr>

                    <tr>
                        <td colspan="5">
                                <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">2. N&uacute;mero de camas:</td>
                        <td>Ofrecidas total mes</td>
                        <td>Ocupadas o vendidas mes</td>
                    </tr>
                    <tr>
                        <td style="text-align:center">'.$modulo4["icda"].'</td>
                        <td style="text-align:center">'.$modulo4["icva"].'</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                                <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="4" style="width: 28%;height:6 px;text-align:left">3. Huespedes - Llegada de personas (Check-In):</td>
                        <td>&nbsp;</td>
                        <td>Residentes en Colombia</td>
                        <td>No Residentes</td>
                        <td>Total huespedes</td>
                    </tr>
                    <tr>
                        <td>a) Por venta directa</td>
                        <td style="text-align:center">'.$modulo4["ihpnvd"].'</td>
                        <td style="text-align:center" >'.$modulo4["ihpnrvd"].'</td>
                        <td style="text-align:center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>b) Por tiempo compartido</td>
                        <td style="text-align:center">'.$modulo4["ihpntc"].'</td>
                        <td style="text-align:center">'.$modulo4["ihpnrtc"].'</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td style="text-align:center">'.$modulo4["ihpn"].'</td>
                        <td style="text-align:center">'.$modulo4["ihpnr"].'</td>
                        <td style="text-align:center">'.$modulo4["huetot"].'</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                                <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                </table>
                

                <table border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                    <tr>
                        <th colspan="3" align="center">TARIFA PROMEDIO POR TIPO DE ACOMODACI&Oacute;N</th>			  			  
                    </tr>
                    <tr>
                        <th colspan="3">&nbsp;</th>			  			  
                    </tr>

                    <tr>
                        <th style="width: 50%;height:6 px;text-align:left">Tipo de habitaci&oacute;n</th>
                        <th style="width: 25%;height:6 px;text-align:left">N&uacute;mero de habitaciones vendidas</th>
                        <th style="width: 24%;height:6 px;text-align:left">Tarifa promedio por tipo de acomodaci&oacute;n (valor en pesos)</th>			  
                    </tr>
                    <tr>
                        <td>1. Sencilla</td>
                        <td style="text-align:center">'.$modulo4["thsen"].'</td>
                        <td style="text-align:center">'.$modulo4["thusen"].'</td>			  
                    </tr>
                    <tr>
                        <td>2. Doble</td>
                        <td style="text-align:center">'.$modulo4["thdob"].'</td>
                        <td style="text-align:center">'.$modulo4["thudob"].'</td>			  
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                </table>
                  

                <table border="1" style="width: 100%; border-width: 1px 1px 1px 1px; font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; border-spacing: 1px; border-collapse: collapse; padding:10px">
                    <tr>
                        <th colspan="3" align="center"><span id="texto1">MOTIVO DE VIAJE DE LOS HU&Eacute;SPEDES</span></th>
                    </tr>
                    <tr>
                        <th style="width: 50%;height:6 px;text-align:left">Motivo de viaje</th>
                        <th style="width: 24%;height:6 px;text-align:center">Residentes %</th>
                        <th style="width: 23%;height:6 px;text-align:center">No Residentes %</th>
                    </tr>
                    <tr>
                        <td><label>1. Vacaciones, ocio y recreo</label></td>
                        <td style="text-align:center">'.$modulo4["mvor"].'</td>
                        <td style="text-align:center">'.$modulo4["mvonr"].'</td>
                    </tr>
                    <tr>
                        <td><label>2. Salud y atenci&oacute;n m&eacute;dica (Incluye tratamientos<br> de atenci&oacute;n est&eacute;tica)</label></td>
                        <td style="text-align:center">'.$modulo4["mvsr"].'</td>
                        <td style="text-align:center">'.$modulo4["mvsnr"].'</td>
                    </tr>
                    <tr>
                        <td><label>3. Trabajo y negocios</label></td>
                        <td style="text-align:center">'.$modulo4["mvnr"].'</td>
                        <td style="text-align:center">'.$modulo4["mvnnr"].'</td>
                    </tr>
                    <tr>
                        <td><label><span id="textoMICE">4. Convenciones (MICE)</span></label></td>
                        <td style="text-align:center">'.$modulo4["mvcr"].'</td>
                        <td style="text-align:center">'.$modulo4["mvcnr"].'</td>
                    </tr>   
                    <tr>
                        <td><label>5. Amercos (imprevistos) </label></td>
                        <td style="text-align:center">'.$modulo4["mvotr"].'</td>
                        <td style="text-align:center">'.$modulo4["mvotnr"].'</td>
                    </tr>
                    <tr>
                        <td><label><span id="textoMICE">6. Otros motivos no relacionados anteriormente (Especifique en observaciones)</span></label></td>
                        <td style="text-align:center">'.$modulo4["mvam"].'</td>
                        <td style="text-align:center">'.$modulo4["mvamnr"].'</td>
                    </tr>   
                    <tr>
                        <td><label>7. Total</label></td>
                        <td style="text-align:center">'.$modulo4["mvott"].'</td>
                        <td style="text-align:center">'.$modulo4["mvottnr"].'</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                                <hr style="color: #99FFFF;" />     
                        </td>
                    </tr>
                </table>
                  <br>
                  <div style="font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10"><b>La no presentaci&oacute;n oportuna de este informe acarrea las sanciones establecidas en la Ley 079 de 1993.</b></div>  
                  <br>
                  <div style="font-family: Arial, Verdana, Trebuchet MS, Helvetica, sans-serif; font-size: 10; text-align:justify"><b>MICE(Meeting, incentives, congresses, exhibitions)</b>, es aquel que abarca las actividades basadas en la organizaci&oacute;n, promoci&oacute;n, venta y distribuci&oacute;n de reuniones y eventos; productos y servicios que incluyen reuniones gubernamentales, de empresas y de asociaciones; viajes de incentivos de empresas, seminarios, congresos, conferencias, convenciones, exposiciones y ferias.</div>
                  <br>';
    $contenido.='</page>';
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8',array(5,10,5,15));
$html2pdf->pdf->SetDisplayMode('fullpage');

$html2pdf->writeHTML($contenido);
$html2pdf->Output('certificadoContratista.pdf');
?>
