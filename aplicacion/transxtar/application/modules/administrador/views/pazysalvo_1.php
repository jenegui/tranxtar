<?php $this->load->helper("url"); 
include_once 'application/libraries/html2pdf-4.4.0/html2pdf.class.php';

    $contenido='<page backtop="55mm" backbottom="34mm" backleft="30mm" backright="30mm" footer="page">';
    $contenido.='<page_header>';
       $contenido.='<img src="'.base_url("images/logoPazySalvo.png").'"/> <label style="font-size: 18px; color: #E00078;"> Encuesta Mensual de Alojamiento (EMA) </label>'; 
    $contenido.='</page_header>';
    $contenido.='<page_footer>';
       $contenido.='<p align="center">DANE: Carrera 59 No. 26-70 Interior I - CAN. Conmutador (571) 5978300 - Fax (571) 5978399<br/>L&iacute;nea gratuita de atenci&oacute;n 01-8000-912002. &oacute; (571) 5978300 Exts. 2532 - 2605</p>'; 
    $contenido.='</page_footer>';
    
    $contenido.='<table width="1%" style="border: 0px solid #CCCCCC;">
                <tr>
                    <td>&nbsp;</td>
                </tr>';
    $contenido.='<tr>';
    $contenido.='<td align="center"><b>EL DEPARTAMENTO ADMINISTRATIVO NACIONAL DE ESTADISTICA - DANE <br> HACE CONSTAR QUE:</b></td>';
    $contenido.='</tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>';
    $contenido.='<tr>
                  <td>LA EMPRESA <b>'.$pyz["idproraz"].'</b></td>
                </tr>
                <tr>
                  <td>NOMBRE COMERCIAL <b>'.$pyz["idnomcom"].'</b></td>
                </tr>
                <tr>
                  <td>N.I.T: '.$pyz["num_identificacion"].'</td>
                </tr>
                <tr>
                  <td>DIRECCION: '.$pyz["iddirecc"].'</td>
                </tr>
                <tr>
                  <td>DEPARTAMENTO: '.$pyz["depto"].'</td>
                </tr>
                <tr>
                  <td>MUNICIPIO: '.$pyz["mpio"].'</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td style="text-align: justify;"> <p style="text-align: justify; font-family: Arial,sans-serif; font-size: 1.1em;">RINDI&Oacute; LA ENCUESTA MENSUAL DE ALOJAMIENTO CORRESPONDIENTE AL PERIODO <b>'.strtoupper($pyz["periodo"]).'</b> Y CUMPLI&Oacute; CON LOS REQUISITOS ESTABLECIDOS EN LA LEY 0079 DEL 20 DE OCTUBRE DE 1993, POR
                      LO CUAL HA SIDO INSCRITA EN SUS ARCHIVOS EN LA ACTIVIDAD DE SERVICIOS CIIU REV3. EL ESTABLECIMIENTO DEBER&Aacute; IDENTIFICARSE CON EL N&Uacute;MERO: '.$pyz["nro_establecimiento"].' PARA TODOS LOS TR&Aacute;MITES
                      REQUERIDOS Y LA INFORMACI&Oacute;N ESTAD&Iacute;STICA QUE LE SEA SOLICITADA POR EL DANE. DE SER NECESARIO, UN FUNCIONARIO DEL DANE SE COMUNICAR&Aacute; CON USTED PARA
                      CONFIRMAR LA INFORMACI&Oacute;N SUMINISTRADA EN ESTE FORMULARIO.</p></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>FECHA DE EXPEDICI&Oacute;N: '.date("d/m/Y").'</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
            </table>';
    $contenido.='</page>';
//echo $contenido;
$html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8',array(5,10,5,15));
$html2pdf->pdf->SetDisplayMode('fullpage');

$html2pdf->writeHTML($contenido);
$html2pdf->Output('certificadoContratista.pdf');
?>
