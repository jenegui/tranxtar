<?php
if ($controller == "miniencuesta") {
    $this->config->load("sitio1");
    $this->load->helper("url");
} else {
    $this->config->load("sitio");
    $this->load->helper("url");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="<?php echo base_url("images/favicon.ico"); ?>">
        <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo base_url("css/ie.css"); ?>" type="text/css" media="screen" /><![endif]-->
            <link rel="stylesheet" href="<?php echo base_url("css/1140.css"); ?>" type="text/css" media="screen" />
            <!--link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("css/custom-theme/jquery-ui-1.8.18.custom.css"); ?>" /-->
            <link rel="stylesheet" href="<?php echo base_url("css/styles.css"); ?>" type="text/css" media="screen" />
            <link rel="stylesheet" href="<?php echo base_url("css/select2.css"); ?>" type="text/css" media="screen" />
           <!--link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" type="text/css"-->
           <link rel="stylesheet" href="<?php echo base_url("css/reportDatatable/jquery.dataTables.min.css"); ?>" type="text/css">
            <!--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" type="text/css">-->
            <link rel="stylesheet" href="<?php echo base_url("css/reportDatatable/buttons.dataTables.min.css"); ?>" type="text/css">
            <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" /-->
            <link href="<?php echo base_url("/css/bootstrap/bootstrap.min.css"); ?>" rel="stylesheet"/>
            <link href="<?php echo base_url("/css/bootstrap/sticky-footer-navbar.css"); ?>" rel="stylesheet"/>
            
            
            <!-- load jQuery 1.10.2 -->


            


            <title><?php echo $this->config->item("title"); ?></title>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <?php $this->load->view("template/headernlog"); ?>

                <?php
                if (isset($menu) && ($menu != ''))
                    $this->load->view($menu);
                else
                    $this->load->view("template/menu");
                ?>

            </div>
        </div>
        <div class="container">
            <div class="row">		
                <div id="container2" class="last">
                    <div id="contenido">
                        <?php $this->load->view($view); ?>
                        <!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/jquery-3.3.1.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/jquery.dataTables.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/dataTables.buttons.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/buttons.flash.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/jszip.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/pdfmake.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/vfs_fonts.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>-->
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/buttons.html5.min.js"); ?>"></script>
                        <!--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>-->    
                        <script type="text/javascript" src="<?php echo base_url("js/reportDatatable/buttons.print.min.js"); ?>"></script>    

                        <script type="text/javascript"> 
                            
                                $('#example').DataTable( {
                                    language: {
                                        processing:     "Procesando...",
                                        search:         "Buscar:",
                                        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                                        info:           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                                        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                                        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                                        infoPostFix:    "",
                                        loadingRecords: "Cargando...",
                                        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                                        emptyTable:     "Aucune donnée disponible dans le tableau",
                                        paginate: {
                                            first:      "Primera",
                                            previous:   "Anterior",
                                            next:       "Siguiente",
                                            last:       "Última"
                                        },
                                        buttons: {
                                            print:      "Imprimir",
                                            copy:       "Copiar"
                                            
                                        },
                                        aria: {
                                            sortAscending:  ": activer pour trier la colonne par ordre croissant",
                                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                                        }
                                    },
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'copy', 'csv', 'excel', 'pdf', 'print'
                                    ],
                                    sPaginationType: "full_numbers",
                                    aaSorting: [[0, "asc" ]],
                                    bPaginate: true,
                                    bLengthChange: true,
                                    bFilter: true,
                                    bSort: true,
                                    bInfo: true,
                                    //bJQueryUI: true,
                                    //bAutoWidth: true, 
                                    processing: true,
                                    //serverSide: true,
                                    responsive: true,
                                    bProcessing: true,
                                } );
                            
                        </script>          
                    </div>
                </div>
            </div>
        </div>  



        <div class="container">
            <div class="row">			
                <?php $this->load->view("template/footer"); ?>
            </div>
        </div>
    			
    </body>
</html> 