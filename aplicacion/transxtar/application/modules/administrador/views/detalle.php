<div class="container">
  <h3>M&oacute;dulo para editar  clientes</h3>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#editar" role="tab" data-toggle="tab">Datos b&aacute;sicos</a></li>
    <li><a href="#tarifas" role="tab" data-toggle="tab">Tarifas</a></li>
    <li><a href="#csharptab" role="tab" data-toggle="tab">Tab3</a></li>
    <li><a href="#mysqltab" role="tab" data-toggle="tab">Tab4</a></li>
    <li><a href="#jquerytab" role="tab" data-toggle="tab">Tab5</a></li>
    
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="editar"><?php $this->load->view("editarfte"); ?></div>
    <div class="tab-pane" id="tarifas"><?php $this->load->view("registrarTarifas"); ?></div>
    <div class="tab-pane" id="csharptab">tab 3</div>
    <div class="tab-pane" id="mysqltab">tab 4</div>
    <div class="tab-pane" id="jquerytab">tab 5</div>
    
  </div>
</div>

