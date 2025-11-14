<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
?>
<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<script type="text/javascript">
<!--

function guardar_informe()
{
  
  if($('#infevolucion_fechaingreso').val()=='')
  {

  alert("Debe llenar la fecha de ingreso...");
  return false;
  }
  
  if($('#infevolucion_situacionactual').val()=='')
  {

  alert("Debe llenar situacion actual...");
  return false;
  }


  $("#informe_g").load("templateformsweb/maestro_standar_atencion/guardar_evo.php",{
  eteneva_id:'<?php echo $_POST["eteneva_id"]; ?>',
  infevolucion_situacionactual:$('#infevolucion_situacionactual').val(),
  infevolucion_rterapeuticas:$('#infevolucion_rterapeuticas').val(),
  infevolucion_rfamiliares:$('#infevolucion_rfamiliares').val(),
  infevolucion_rescolares:$('#infevolucion_rescolares').val(),
  infevolucion_rmultidiciplinarias:$('#infevolucion_rmultidiciplinarias').val(),
  infevolucion_fechaingreso:$('#infevolucion_fechaingreso').val(),
  usua_id:'<?php echo $_POST['usua_id']; ?>',
  infevolucion_diagnostico:$('#infevolucion_diagnostico').val()

  },function(result){  
 

  });  
  $("#informe_g").html("Espere un momento"); 

}
//  End -->
</script>
<?php

$lista_atencioneval="select * from dns_atencionevaluacion where eteneva_id=?";
$rs_atencioneval = $DB_gogess->executec($lista_atencioneval,array($_POST["eteneva_id"]));

$lista_atencion="select * from dns_atencion where atenc_enlace=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($rs_atencioneval->fields["atenc_enlace"]));

$datos_cliente="select * from app_cliente where clie_id=".$rs_atencioneval->fields["clie_id"];
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());

?>
<div class="Estilo2" >
<?php
echo  "<b>Fecha de Entrega:</b>".$rs_atencioneval->fields["eteneva_fechaentrega"]."<br>";
echo  "<b>Observaci&oacute;n:</b>".$rs_atencioneval->fields["eteneva_observacion"];

$busca_datos="select * from faesa_informeevolucionsemestral where eteneva_id=".$_POST["eteneva_id"]."  and clie_id=".$rs_atencioneval->fields["clie_id"]." and usua_id='".$_POST["usua_id"]."'";
$rs_bdatos = $DB_gogess->executec($busca_datos,array());

?></div>
 <table width="100%" border="1" cellpadding="1" cellspacing="0">
    <tr>
      <td><div align="center" class="Estilo4">ESTABLECIMIENTO</div></td>
      <td><div align="center" class="Estilo4">NOMBRE</div></td>
      <td><div align="center" class="Estilo4">APELLIDO</div></td>
      <td><div align="center" class="Estilo4">SEXO (M-F) </div></td>
      <td><div align="center" class="Estilo4">No HISTORIA CLINICA </div></td>
    </tr>
    <tr>
      <td><span class="Estilo2">FAESA <?php echo $nciudad ?></span></td>
      <td><span class="texto_caja Estilo1 Estilo3">
        <?php  echo utf8_encode($rs_dcliente->fields["clie_nombre"]); ?>
      </span></td>
      <td><span class="texto_caja Estilo1 Estilo3">
        <?php  echo utf8_encode($rs_dcliente->fields["clie_apellido"]); ?>
      </span></td>
      <td> <span class="Estilo2">
      <?php  echo $rs_dcliente->fields["clie_genero"]; ?>
      </span></td>
      <td><span class="Estilo2">
      <?php  echo $rs_atencion->fields["atenc_hc"]; ?>
      </span></td>
    </tr>
</table>
<br><br>

<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Diagn&oacute;stico</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_diagnostico" cols="50" rows="6" id="infevolucion_diagnostico"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_diagnostico"]);
		  ?></textarea>
        </div>
</div>


<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Situaci&oacute;n actual</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_situacionactual" cols="50" rows="6" id="infevolucion_situacionactual"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_situacionactual"]);
		  ?></textarea>
        </div>
</div>


<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Recomendaciones Terap&eacute;uticas</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_rterapeuticas" cols="50" rows="6" id="infevolucion_rterapeuticas"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_rterapeuticas"]);
		  ?></textarea>
        </div>
</div>


<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Recomendaciones Familiares</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_rfamiliares" cols="50" rows="6" id="infevolucion_rfamiliares"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_rfamiliares"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Recomendaciones Escolares</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_rescolares" cols="50" rows="6" id="infevolucion_rescolares"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_rescolares"]);
		  ?></textarea>
        </div>
</div>


<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Recomendaciones Multidisciplinarias</label>
		<div class="col-xs-9 Estilo2">
		  <textarea name="infevolucion_rmultidiciplinarias" cols="50" rows="6" id="infevolucion_rmultidiciplinarias"><?php
		  echo trim(@$rs_bdatos->fields["infevolucion_rmultidiciplinarias"]);
		  ?></textarea>
        </div>
</div>


<div class="form-group">
		<label class="control-label col-xs-3 Estilo4">Fecha ingreso</label>
		<div class="col-xs-9 Estilo2">   
		  <?php
		  echo $objformulario->fecha_bloque("d-m-Y","infevolucion_fechaingreso",trim(@$rs_bdatos->fields["infevolucion_fechaingreso"]),'');
		  echo '<input name="infevolucion_fechaingreso" id="infevolucion_fechaingreso" type="hidden" value="'.trim(@$rs_bdatos->fields["infevolucion_fechaingreso"]).'" >';
		  ?>
	   
	    </div>
</div>


<div class="form-group">
<div class="col-xs-12">
<?php

if($rs_bdatos->fields["infevolucion_id"])
{
  
  echo '<div class="Estilo2" >Registrado por: '.$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_bdatos->fields["usua_id"],$DB_gogess)."<br>";
  echo 'Fecha resgistro: '.$rs_bdatos->fields["infevolucion_fecharegistro"]."</div>";
}

?>
</div>
</div>
<p>&nbsp;</p>
<div class="form-group">
<div class="col-xs-6">
<center><input type="button" name="Submit" value="Guardar Informe" onClick="guardar_informe()"></center>
</div>
<div class="col-xs-6">
<center><input type="button" name="Submit" value="Imprimir Informe" onClick="ver_informeevolucion(1,'<?php echo $_POST["eteneva_id"]; ?>')"></center>
</div>
</div>

<div id="informe_g"></div>

<script>
var config1 ={
  toolbarGroups: [
						{"name":"basicstyles","groups":["basicstyles"]},
						{"name":"paragraph","groups":["list","blocks"]},
						{"name":"styles","groups":["styles"]}
					],
					// Remove the redundant buttons from toolbar groups defined above.
					removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
}



$('#infevolucion_diagnostico').ckeditor(config1);
$('#infevolucion_situacionactual').ckeditor(config1);	  
$('#infevolucion_rterapeuticas').ckeditor(config1);	
$('#infevolucion_rfamiliares').ckeditor(config1);	
$('#infevolucion_rescolares').ckeditor(config1);	
$('#infevolucion_rmultidiciplinarias').ckeditor(config1);

//$( "#infevolucion_fechaingreso" ).datepicker({dateFormat: 'yy-mm-dd'});

</script>