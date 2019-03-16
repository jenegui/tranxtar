<?php
$this->load->library("session");
$this->load->helper("url");
$url = site_url("images/edit.png");
//if (count($fuentes) > 0) {
    for ($i = 0; $i < count($fuentes); $i++) {
        $datas[] = array('NumEstabl' => $fuentes[$i]['nro_establecimiento'],
            'NombreEstablecimiento' => $fuentes[$i]['idnomcom'],
            'NIT' => $fuentes[$i]['nit_establecimiento'],
            'Dierccion' => $fuentes[$i]['iddirecc'],
            'telefono' => $fuentes[$i]['idtelno'],
            'email' => $fuentes[$i]['idcorreo'],
            'Contacto' => $fuentes[$i]['nom_contacto'],
            'Departamento' => $fuentes[$i]['fk_depto'],
            'Municipio' => $fuentes[$i]['fk_mpio'],
            'Estado' => $fuentes[$i]['estado']);
    }
    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($fuentes),
        "iTotalDisplayRecords" => count($fuentes),
        "aaData" => $datas);
    echo json_encode($results);
/*} else {
    $datas[] = array('NumGuia' => "",
        'IdCliente' => "",
        'nomCliente' => "",
        'fecRecogida' => "",
        'fecEntrega' => "",
        'IdDestinatario' => "",
        'nomDestinatario' => "",
        'valorFlete' => "",
        'fecRegistro' => "",
        'estadoCarga' => "",
        'veDetalle' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($control),
    "iTotalDisplayRecords" => count($control),
    "aaData" => $datas,);
echo json_encode($results);*/
?>