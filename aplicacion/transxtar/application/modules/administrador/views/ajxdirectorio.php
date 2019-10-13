<?php
$this->load->library("session");
$this->load->helper("url");
$url = site_url();
if (count($fuentes) > 0) {
    for ($i = 0; $i < count($fuentes); $i++) {
        $editar = '<a href=administrador/editarFuente/'.$fuentes[$i]['nro_establecimiento'].' onclick=\"editarDestinatario('.$fuentes[$i]['nro_establecimiento'].')\"><img border=\"0px\" src="'.$url.'/images/edit.png" alt=\"Editar\"/></a>';
        $datas[] = array('NumEstabl' => $fuentes[$i]['nro_establecimiento'],
            'NombreEstabl' => $fuentes[$i]['idnomcom'],
            'idEstablecimiento' => $fuentes[$i]['nit_establecimiento'],
            'Dierccion' => $fuentes[$i]['iddirecc'],
            'telefono' => $fuentes[$i]['idtelno'],
            'email' => $fuentes[$i]['idcorreo'],
            'Contacto' => $fuentes[$i]['nom_contacto'],
            'Departamento' => $fuentes[$i]['fk_depto'],
            'Municipio' => $fuentes[$i]['fk_mpio'],
            'CostoManejo' => ($fuentes[$i]['costomanejo']*100).'%',
            'Comercial' => $fuentes[$i]['nom_comercial'],
            'Estado' => $fuentes[$i]['estado'],
            'editar' => $editar);
    }
    /*$results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($fuentes),
        "iTotalDisplayRecords" => count($fuentes),
        "aaData" => $datas);
    echo json_encode($results);*/
} else {
    $datas[] = array('NumEstabl' => "",
        'NombreEstabl' => "",
        'idEstablecimiento' => "",
        'Dierccion' => "",
        'telefono' => "",
        'email' => "",
        'Contacto' => "",
        'Departamento' => "",
        'Municipio' => "",
        'CostoManejo' => "",
        'Comercial' => "",
        'Estado' => "",
        'editar' => "");
}
$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($fuentes),
    "iTotalDisplayRecords" => count($fuentes),
    "aaData" => $datas,);
echo json_encode($results);
?>