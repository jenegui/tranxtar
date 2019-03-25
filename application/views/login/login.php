<?php $this->load->helper("url");?>
<h1>Bienvenido a la aplicacion web de TRANSXTAR</h1>
<p>El objetivo de esta aplicaci&oacute;n llevar el registro en l&iacute;nea de las operaciones log&iacute;sticas de la empresa mediante el registro y control de las guias, de los clientes y destinatarios, tambi&eacute;n permite la generaci&oacute;n  de indicadores de gesti&oacute;n los cuales permiten guiar la implementaci&oacute;n de medidas o pol&iacute;ticas que beneficien la empresa. </p>
<br/>

<br/><br/>
<div id="login">
	<form id="frmIngresar" name="frmIngresar" method="post" action="<?php echo site_url("login/validar"); ?>" accept-charset="utf-8">				
	<table>
	<tr>
		<td><label>Login:</label></td>
		<td><input type="text" id="txtLogin" name="txtLogin" value="" size="15" maxlength="15" class="txtLogin"/></td>
	</tr>
	<tr>
		<td><label>Password:</label></td>
		<td><input type="password" id="txtPassword" name="txtPassword" value="" size="15" maxlength="15" class="txtLogin"/></td>
	</tr>
	<tr>
	    <td colspan="2">
                <?php 
                if($this->session->userdata("error_login")==1){
                    echo "<p style = 'font-size:12 px ; color: red'> Login/Password Incorrectos</p>";
                }else{
                    echo "&nbsp;";
                }
               ?>
                
            </td>
	</tr>
	<tr>
	    <td colspan="2" align="center"><input type="submit" id="btnIngresar" name="btnIngresar" value="Ingresar" class="button"/></td>
	</tr>
	</table>
	</form>
</div>
<br/><br/>