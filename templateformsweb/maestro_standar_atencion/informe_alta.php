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
if($_SESSION['ces1313777_sessid_inicio'])
{
$objformulario= new  ValidacionesFormulario();
$comillasimple="'";

$clie_id=$_POST["pVar1"];
$atenc_id=$_POST["pVar2"];

$lista_atencion="select * from dns_atencion where atenc_id=?";
$rs_atencion = $DB_gogess->executec($lista_atencion,array($atenc_id));

//busca datos del paciente
$datos_cliente="select * from app_cliente where clie_id=".$clie_id;
$rs_dcliente = $DB_gogess->executec($datos_cliente,array());
//busca datos del paciente

$datos_usuario="select * from  app_usuario where usua_id=".$_SESSION['ces1313777_sessid_inicio'];
$rs_usuario = $DB_gogess->executec($datos_usuario,array());


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$rs_usuario->fields["centro_id"],$DB_gogess);
?>
<script type="text/javascript">
<!--

function guardar_informe()
{



 if($('#val_avances').val()=='')
  {

  alert("Debe llenar avances...");
  return false;
  }

  if($('#val_concluciones').val()=='')
  {

  alert("Debe llenar conclusiones...");
  return false;

  }

  if($('#infoalta_fechaalta').val()=='')
  {

  alert("Debe llenar la fecha de alta...");
  return false;

  }
  
  if($('#infoalta_fechaevaluacioninicial').val()=='')
  {

  alert("Debe llenar la fecha de evaluacion inicial...");
  return false;

  }  
  
  if($('#infoalta_fechainiciopt').val()=='')
  {

  alert("Debe llenar la fecha de inicio...");
  return false;

  }    

  $("#informe_g").load("templateformsweb/maestro_standar_atencion/guardar_alta.php",{
  atenc_id:'<?php echo $atenc_id ?>',
  clie_id:'<?php echo $clie_id ?>',
  val_avances:$('#val_avances').val(),
  val_concluciones:$('#val_concluciones').val(),
  val_recomendaciones:$('#val_recomendaciones').val(), 
  infoalta_rterapeuticas:$('#infoalta_rterapeuticas').val(),
  infoalta_rfamiliares:$('#infoalta_rfamiliares').val(),
  infoalta_rescolares:$('#infoalta_rescolares').val(),
  infoalta_rmultidiciplinarias:$('#infoalta_rmultidiciplinarias').val(), 
  usua_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
  val_diagnostico:$('#val_diagnostico').val(),
  infoalta_fechaalta:$('#infoalta_fechaalta').val(),
  infoalta_fechaevaluacioninicial:$('#infoalta_fechaevaluacioninicial').val(),
  infoalta_fechainiciopt:$('#infoalta_fechainiciopt').val()
  

  },function(result){  
 

  });  
  $("#informe_g").html("Espere un momento"); 

  

}

//  End -->
</script>

<style type="text/css">
<!--
.Estilo1 {font-size: 11px}
.Estilo2 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo4 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<?php
$busca_datos="select * from faesa_informealta where atenc_id=".$atenc_id."  and clie_id=".$clie_id." and usua_id=".$_SESSION['ces1313777_sessid_inicio'];
$rs_bdatos = $DB_gogess->executec($busca_datos,array());

?>

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
		<label class="control-label col-xs-2 Estilo4">Diagn&oacute;stico</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="val_diagnostico" cols="50" rows="6" id="val_diagnostico"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_diagnostico"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Avances</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="val_avances" cols="50" rows="6" id="val_avances"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_avance"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Conclusiones</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="val_concluciones" cols="50" rows="6" id="val_concluciones"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_concluciones"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Recomendaciones</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="val_recomendaciones" cols="50" rows="6" id="val_recomendaciones"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_recomendaciones"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Recomendaciones Terapeuticas</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="infoalta_rterapeuticas" cols="50" rows="6" id="infoalta_rterapeuticas"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_rterapeuticas"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Recomendaciones Familiares</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="infoalta_rfamiliares" cols="50" rows="6" id="infoalta_rfamiliares"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_rfamiliares"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Recomendaciones Escolares</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="infoalta_rescolares" cols="50" rows="6" id="infoalta_rescolares"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_rescolares"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Recomendaciones Multidisciplinarias</label>
		<div class="col-xs-10 Estilo2">
		  <textarea name="infoalta_rmultidiciplinarias" cols="50" rows="6" id="infoalta_rmultidiciplinarias"><?php
		  echo trim(@$rs_bdatos->fields["infoalta_rmultidiciplinarias"]);
		  ?></textarea>
        </div>
</div>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Fecha Alta</label>
		<div class="col-xs-10 Estilo2">
		  <?php
		  echo $objformulario->fecha_bloque("d-m-Y","infoalta_fechaalta",trim(@$rs_bdatos->fields["infoalta_fechaalta"]),'');
		  echo '<input name="infoalta_fechaalta" id="infoalta_fechaalta" type="hidden" value="'.trim(@$rs_bdatos->fields["infoalta_fechaalta"]).'" >';
		  ?>
		  
        </div>
</div>

<p>&nbsp;</p>
<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Fecha de Evaluacion Inicial</label>
		<div class="col-xs-10 Estilo2">
		  <?php
		  echo $objformulario->fecha_bloque("d-m-Y","infoalta_fechaevaluacioninicial",trim(@$rs_bdatos->fields["infoalta_fechaevaluacioninicial"]),'');
		  echo '<input name="infoalta_fechaevaluacioninicial" id="infoalta_fechaevaluacioninicial" type="hidden" value="'.trim(@$rs_bdatos->fields["infoalta_fechaevaluacioninicial"]).'" >';
		  ?>
		  
        </div>
</div>


<p>&nbsp;</p>

<div class="form-group">
		<label class="control-label col-xs-2 Estilo4">Fecha de Inicio por area</label>
		<div class="col-xs-10 Estilo2">
		  <?php
		  echo $objformulario->fecha_bloque("d-m-Y","infoalta_fechainiciopt",trim(@$rs_bdatos->fields["infoalta_fechainiciopt"]),'');
		  echo '<input name="infoalta_fechainiciopt" id="infoalta_fechainiciopt" type="hidden" value="'.trim(@$rs_bdatos->fields["infoalta_fechainiciopt"]).'" >';
		  ?>
		  
        </div>
</div>

<br>
<div class="form-group">
<div class="col-xs-12">
<?php

if($rs_bdatos->fields["infoalta_id"])
{
  
  echo '<div class="Estilo2" >Registrado por: '.$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id =",$rs_bdatos->fields["usua_id"],$DB_gogess)."<br>";
  echo 'Fecha resgistro: '.$rs_bdatos->fields["infoalta_fecharegistro"]."</div>";
}

?>
</div>
</div>

<br>

<div class="form-group">
<div class="col-xs-6">
<center><input type="button" name="Submit" value="Guardar Informe" onClick="guardar_informe()"></center>
</div>
<div class="col-xs-6">
<center><input type="button" name="Submit" value="Imprimir Informe" onClick="ver_informealta(2,'<?php echo $atenc_id; ?>')"></center>
</div>
</div>

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



$('#val_diagnostico').ckeditor(config1);
$('#val_avances').ckeditor(config1);
$('#val_concluciones').ckeditor(config1);	 
$('#val_recomendaciones').ckeditor(config1);	 

$('#infoalta_rterapeuticas').ckeditor(config1);
$('#infoalta_rfamiliares').ckeditor(config1);
$('#infoalta_rescolares').ckeditor(config1);
$('#infoalta_rmultidiciplinarias').ckeditor(config1);

</script>

<div id="informe_g"></div>
<?php
}			
else
{
echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';
	
}

?>