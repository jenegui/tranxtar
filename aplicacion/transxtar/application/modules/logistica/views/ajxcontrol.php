<?php
$this->load->library("session");
$this->load->helper("url");

$url = site_url();
//echo '<img scr="'.$url.'("images/edit.png")">';
if (count($control) > 0) {
    for ($i = 0; $i < count($control); $i++){
        if($usuario==4){
            $editar = '<a href=traficoseguridad/editarControlTraficoySeg/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }elseif($usuario==6){
            $editar = '<a href=administrador/editarControlContable/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }else{
            $editar = '<a href=traficoseguridad/editarControl/'.$control[$i]['id_control'].' onclick=\"editarDestinatario('.$control[$i]['id_control'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        }
        if($usuario==6){
            $campo1=$control[$i]['estado_contable'];
            $campo2=$control[$i]['estado_recaudo'];
        }elseif($usuario==2){
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['estado_control'];
        }else{
            $id_control=$control[$i]['id_control'];
            $campo1='<a href=administrador/imprimirGuia/'.$id_control.'><img border=\"0px\" src="'.$url.'/images/impresora.png" alt=\"Imprimir\"/></a>';
            $campo2=$control[$i]['fechaActualizacion'];
        }
        if($control[$i]['nro_placa']==''){
            $placa=$control[$i]['nro_placa'];
        }else{
            $placa=$control[$i]['placa_ext'];
        }
        $datas[] = array('NumGuia' => "G-".$control[$i]['id_control'],
            'nomCliente' => $control[$i]['idnomcom'],
            'ciudadOrigen' => $control[$i]['ciudad_origen'],
            'fecRecogida' => $control[$i]['fecha_recogida'],
            'fecEntrega' => $control[$i]['fecha_entrega'],
            'nomDestinatario' => $control[$i]['nombre_destinatario'],
            'ciudadDest' => $control[$i]['ciudadDest'],
            'noPlacaI' => $control[$i]['nro_placa'],
            'noPlacaE' => $control[$i]['placa_ext'],
            'fecRegistro' => $campo2,
            'estadoCarga' => $control[$i]['nom_estado'],
            'Editar'=>$editar,
            'Imprimir' => $campo1);
    }
} else {
    $datas[] = array('NumGuia' => "",
        'nomCliente' => "",
        'ciudadOrigen' => "",
        'fecRecogida' => "",
        'fecEntrega' => "",
        'nomDestinatario' => "",
        'ciudadDest' => "",
        'noPlacaI' => "",
        'noPlacaE' => "",
        'fecRegistro' => "",
        'estadoCarga' => "",
        'Editar'=>"",
        'Imprimir' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($control),
    "iTotalDisplayRecords" => count($control),
    "aaData" => $datas);

echo json_encode($results);
?>