<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;



$lista_servicios="select requ_id,usua_id,app_requerimiento.catag_id,catag_nombre,requ_observacion from app_requerimiento inner join  app_catalogo on app_requerimiento.catag_id=app_catalogo.catag_id where requ_id=".$_POST["requidp"]." order by requ_id desc";
$rs_data = $DB_gogess->executec($lista_servicios,array());
?>

<!-- despliegue -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" style="color:#006600" >Lista manos levantadas para (Categor&iacute;a:<?php echo $rs_data->fields["catag_nombre"]; ?> -- Solicitud: <?php  echo $rs_data->fields["requ_observacion"]; ?>)</h3>
  </div>
  <div class="panel-body">
  
  <?php
  $foto_p="";
  $img_aceptado="";
 $lista_manos="select * from app_manolevantada inner join app_usuario on app_manolevantada.usua_id=app_usuario.usua_id where requ_id=".$rs_data->fields["requ_id"];
 $rs_listamanos = $DB_gogess->executec($lista_manos,array());
  if($rs_listamanos)
   {
	  while (!$rs_listamanos->EOF) {	
	  
	   $foto_p="";
       $img_aceptado="";
	   
	  if($rs_listamanos->fields["usua_archivo"])
	  {
	   $foto_p="archivo/".$rs_listamanos->fields["usua_archivo"];
	  }
	  else
	  {
	  $foto_p="images/logo_email.png";
	  }
	  
	  if($rs_listamanos->fields["manol_aceptado"])
	  {
	   $img_aceptado="images/aceptar_on.png";
	  }
	  else
	  {
	  $img_aceptado="images/aceptar_off.png";
	  }
	  ?>
	  <blockquote >
 
 <div class="row">
  <div class="col-xs-2"><img src="<?php echo $foto_p; ?>" alt="Foto" class="img-thumbnail" width="130" height="130"></div>
  <div class="col-xs-4"><?php echo utf8_encode($rs_listamanos->fields["usua_nombre"]." ".$rs_listamanos->fields["usua_apellido"]); ?><br><small><?php echo utf8_encode($rs_data->fields["catag_nombre"]); ?></small>
  <br>
   <div class="row">
	  <div class="col-xs-2" >
	  <img src="images/mlevantada.png">
	  </div>
	  <div class="col-xs-2" onClick="ver_servicios_p('<?php echo $rs_listamanos->fields["manol_id"]; ?>','<?php echo $rs_listamanos->fields["usua_id"]; ?>')" style="cursor:pointer" >
	  <img src="images/servicio_btn.png">
	  </div>
	  <div class="col-xs-2" onClick="ver_referencias_p('<?php echo $rs_listamanos->fields["manol_id"]; ?>','<?php echo $rs_listamanos->fields["usua_id"]; ?>')" style="cursor:pointer" >
	  <img src="images/referencia_btn.png">
	  </div>
	  <div class="col-xs-2" onClick="aceptar_us('<?php echo $rs_listamanos->fields["manol_id"]; ?>','<?php echo $rs_listamanos->fields["usua_id"]; ?>')" style="cursor:pointer" id="aceptar_onoff<?php echo $rs_listamanos->fields["manol_id"]; ?>" >
	  <img src="<?php echo $img_aceptado; ?>">
	  </div>
   </div>
  
  
 </div>
 
 
 <div class="row">
 <div class="col-xs-10">
 <div id="lista_rs<?php echo $rs_listamanos->fields["manol_id"]; ?>"></div>
 </div>
 </div>
  
 
</blockquote>
	  <?php
	  $rs_listamanos->MoveNext();	   
	  }
  }
  
  ?>
  
  
  </div>
</div>
<!-- despliegue -->